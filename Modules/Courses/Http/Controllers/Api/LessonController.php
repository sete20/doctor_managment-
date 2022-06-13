<?php

namespace Modules\Courses\Http\Controllers\Api;

use Helper\NotificationHelper;
use Helper\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Lesson;
use Modules\Courses\Repositories\Api\LessonRepository;
use Modules\Courses\Transformers\Api\LessonResource;

class LessonController extends Controller
{
    private $lesson;
    private $model;

    function __construct(LessonRepository $lesson)
    {
        $this->lesson = $lesson;
        $this->model = new Lesson;
    }

    public function index(Request $request)
    {
        $rules = [
            'chapter_id' => 'required|exists:chapters,id'
        ];

        $data = validator()->make($request->all(), $rules, [
            'chapter_id.required' => 'chapter id required',
            'chapter_id.exists' => 'chapter id required',
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first(), $data->errors());

        $lessons = $this->lesson->getPagination($request);

        return (LessonResource::collection($lessons))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    public function questions(Request $request)
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

        $lessons = $this->lesson->getPagination($request);

        return (LessonResource::collection($lessons))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    public function completeVideo(Request $request)
    {
        $user = $request->user('api-client');

        $rules = [
            'lesson_id' => 'required|exists:lessons,id'
        ];

        $data = validator()->make($request->all(), $rules, [
            'lesson_id.required' => 'video id required',
            'lesson_id.exists' => 'video id required',
        ]);

        if ($data->fails()) {
            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        $lesson = $this->model->lesson()->whereHas('chapter', function ($q) use ($user, $request) {
            $q->whereIn('course_id', $user->courses->pluck('id')->toArray());

        })->find($request->lesson_id);

        if (!$lesson) {
            return Response::responseJson(0, 'course not asked by you');
        }

        $user->lessonCompletes()->sync([$lesson->id]);
        if (setting('points', 'video')) {

            $user->increment('points', setting('points', 'video'));
            NotificationHelper::sendNotification($lesson, $user->id, 'clients',
                'تم إضافة نقاط إلي رصيدك',
                'تم إضافة ' . setting('points', 'video') . ' إلي رصيدك لإكمالك مشاهدة الفيديو ' . optional($lesson)->translate(locale())->title);

        }

        return Response::responseJson(1, __('app::dashboard.messages.created'));
    }
}
