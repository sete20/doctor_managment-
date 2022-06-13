<?php

namespace Modules\Courses\Repositories\Doctor;

use Helper\NotificationHelper;
use Illuminate\Http\Request;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Courses\Entities\Lesson;

class QuizRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Lesson::class);
    }

    public function getModel()
    {
        return $this->model->Doctor();
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        $data['order'] = $request->order ? $request->order : $this->model->count() + 1;
        $data['type'] = 'quiz';
        unset($data['title']);
        unset($data['description']);
        return parent::prepareData($data, $request, $is_create);
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        $this->translateTable($model, $request);

        foreach ($request->questions as $question_key => $question) {
            $question = $model->questions()->create([
                'status' => 1,
                'title' => $question,
            ]);

            if (isset($request->answers[$question_key])) {
                foreach ($request->answers[$question_key] as $answer_key => $answer) {
                    $question->answers()->create([
                        'status' => 1,
                        'title' => $answer,
                        'true_answer' => isset($request->is_true_answer[$answer_key]) ? 1 : 0
                    ]);
                }
            }
        }

        if ($model->chapter->course->acceptedRequests()->count())
            NotificationHelper::sendNotification($model,
                $model->chapter->course->acceptedRequests()->pluck('client_id')->toArray(), 'clients',
                __('app::dashboard.notifications.new_quiz_title'),
                __('app::dashboard.notifications.new_quiz_body_for_course') . optional(optional($model->chapter)->course)->translate(locale())->title);

        parent::modelCreated($model, $request, $is_created);
    }

    public function modelUpdated($model, $request): void
    {
        $this->translateTable($model, $request);
        $model->questions()->delete();

        foreach ($request->questions as $question_key => $question) {
            $question = $model->questions()->create([
                'status' => 1,
                'title' => $question,
            ]);

            if (isset($request->answers[$question_key])) {
                foreach ($request->answers[$question_key] as $answer_key => $answer) {
                    $question->answers()->create([
                        'status' => 1,
                        'title' => $answer,
                        'true_answer' => isset($request->is_true_answer[$answer_key]) ? 1 : 0
                    ]);
                }
            }
        }

        parent::modelUpdated($model, $request);
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {

            $model->translateOrNew($locale)->title = $value;
            $model->translateOrNew($locale)->description = isset($request['description'][$locale]) ? $request['description'][$locale] : null;
        }

        $model->save();
    }

}
