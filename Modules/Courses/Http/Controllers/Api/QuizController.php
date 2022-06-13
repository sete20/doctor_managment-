<?php

namespace Modules\Courses\Http\Controllers\Api;

use Helper\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Repositories\Api\QuizRepository;
use Modules\Courses\Transformers\Api\FaqResource;
use Modules\Courses\Transformers\Api\LessonResource;

class QuizController extends Controller
{
    private $quiz;

    function __construct(QuizRepository $quiz)
    {
        $this->quiz = $quiz;
    }

    public function index(Request $request)
    {
        $rules = [
            'quiz_id' => 'required|exists:lessons,id'
        ];

        $data = validator()->make($request->all(), $rules, [
            'quiz_id.required' => 'quiz id required',
            'quiz_id.exists' => 'quiz id required',
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first(), $data->errors());


        $questions = $this->quiz->getPagination($request , $request->quiz_id);

        return (FaqResource::collection($questions))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    public function listAnsweredQuiz(Request $request)
    {
        $quiz = $this->quiz->answeredQuiz($request);

        return (LessonResource::collection($quiz))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    public function quizAnswer(Request $request)
    {
        $rules = [
            'quiz_id' => 'required|exists:lessons,id',
            'answers' => 'required|array',
            'answers.*' => 'exists:answers,id',
        ];

        $data = validator()->make($request->all(), $rules, [
            'quiz_id.required' => 'Quiz id required',
            'quiz_id.exists' => 'Quiz id required',
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first(), $data->errors());

        $response = $this->quiz->answer($request);

        if($response['status'] == 1){
            return Response::responseJson(1,'success', isset($response['data']) ? $response['data'] : null);
        }else {
            return Response::responseJson(0 , $response['message'] , isset($response['data']) ? $response['data'] : null);
        }
    }
}
