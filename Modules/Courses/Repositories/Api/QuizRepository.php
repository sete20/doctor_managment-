<?php

namespace Modules\Courses\Repositories\Api;

use Helper\NotificationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Courses\Entities\Lesson;
use Modules\Courses\Transformers\Api\FaqResource;

class QuizRepository
{
    private $quiz;

    function __construct(Lesson $quiz)
    {
        $this->quiz = $quiz;
    }

    public function getAll($request, $quizId, $order = 'order', $sort = 'asc')
    {
        return $this->buildQuery($request, $quizId, $order, $sort)->get();
    }

    public function getPagination($request, $quizId, $order = 'order', $sort = 'asc')
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        return $this->buildQuery($request, $quizId, $order, $sort)->paginate($paginate);
    }

    public function answeredQuiz(Request $request, $order = 'order', $sort = 'asc')
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        $user = $request->user('api-client');

        return $user->answeredQuiz()->where(function ($q) use ($request) {
            $q->whereHas('chapter', function ($q) use ($request) {
                if ($request->chapter_id) {
                    $q->where('chapter_id', $request->chapter_id);
                }
                if ($request->course_id) {
                    $q->whereHas('course', function ($q) use ($request) {

                            $q->where('course_id', $request->course_id);
                    });
                }
            });
        })->orderBy($order,$sort)->paginate($paginate);
    }

    private function buildQuery($request, $quizId, $order = 'order', $sort = 'asc')
    {
        $quiz = $this->findById($quizId);
        return $quiz->questions()->where(function ($q) use ($request) {

            if ($request->question_id):
                $q->where('id', $request->id);
            endif;

        })->orderBy($order, $sort);
    }

    public function findById($id)
    {
        $quiz = $this->quiz->Active()->quiz()->find($id);
        return $quiz;
    }

    public function answer(Request $request)
    {
        $answers = $request->answers;
        $user = $request->user('api-client');
        $quiz = $this->findById($request->quiz_id);
        $questions = $quiz->questions()->Active()->get();
        $already_answered = $user->quiz()->where('quiz_id', $quiz->id)->first();

        if ($already_answered)
            return ['status' => 0, 'message' => 'quiz already answered'];

        DB::beginTransaction();
        try {
            if (count($questions) != count($request->answers))
                return ['status' => 0, 'message' => 'answers not enough'];

            $correct_answers_count = 0;

            foreach ($questions as $question) {

                if (isset($answers[$question->id])) {

                    $question_answers_ids = $question->answers()->Active()->pluck('id')->toArray();

                    if (in_array($answers[$question->id], $question_answers_ids)) {

                        $wright_answers = $question->answers()->Active()->where('true_answer', 1)->pluck('id')->toArray();

                        if (in_array($answers[$question->id], $wright_answers)) {
                            $correct_answers_count += 1;
                        }

                        $user->answers()->create([
                            'faq_id' => $question->id,
                            'answer_id' => $answers[$question->id],
                        ]);
                    } else {

                        return ['status' => 0, 'message' => 'wrong answer'];
                    }
                } else {

                    return ['status' => 0, 'message' => 'question not found', 'data' => new FaqResource($question)];
                }
            }

            $response = $user->quiz()->create([
                'quiz_id' => $quiz->id,
                'wright_answers_count' => $correct_answers_count,
                'question_count' => count($questions),
            ]);

            DB::commit();

            if(setting('points','quiz') && $correct_answers_count * setting('points','quiz') > 0){
                $user->increment('points',$correct_answers_count * setting('points','quiz'));
                NotificationHelper::sendNotification($quiz,$user->id, 'clients',
                    'تم إضافة نقاط إلي رصيدك',
                    'تم إضافة ' . setting('points','quiz').' إلي رصيدك لإكمالك حل الإختبار ' . optional($quiz)->translate(locale())->title);

            }

            return ['status' => 1, 'message' => 'success', 'data' => $response];

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
