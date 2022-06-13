<?php

namespace Modules\Courses\Http\Controllers\Api;

use Helper\Response;
use Illuminate\Http\Request;
use Modules\Courses\Entities\Course;
use Illuminate\Routing\Controller;
use Modules\Courses\Http\Requests\Api\CourseRequest;
use Modules\Courses\Repositories\Api\ChapterRepository;
use Modules\Courses\Transformers\Api\ChapterResource;
use Modules\Courses\Transformers\Api\CourseResource;
use Modules\Courses\Repositories\Api\CourseRepository;

class ChapterController extends Controller
{
    private $course;
    private $chapter;

    function __construct(ChapterRepository $chapter, CourseRepository $course)
    {
        $this->chapter = $chapter;
        $this->course = $course;
    }

    public function index(Request $request)
    {
        $rules = [
            'course_id' => 'required|exists:courses,id'
        ];

        $data = validator()->make($request->all(), $rules, [
            'course_id.required' => 'course id is required',
            'course_id.exists' => 'course id is required',
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first(), $data->errors());

        $chapters = $this->chapter->getPagination($request);
        $course = $this->course->findById($request->course_id);

        return (ChapterResource::collection($chapters))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
            'course_intro_video' => $course ? $course->getFirstMediaUrl('intro_video') : '',
        ]);
    }

    public function requestCourse(Request $request)
    {
        $rules = [
            'course_id' => 'required|exists:courses,id'
        ];

        $data = validator()->make($request->all(), $rules, [
            'course_id.required' => 'course id is required',
            'course_id.exists' => 'course id is required',
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first(), $data->errors());

        $course = $this->course->findById($request->course_id);

        if (!$course)
            return Response::responseJson(0, 'course not found');

        $request = $this->course->request($request, $course);

        if (isset($request['status']) && $request['status'] == 0)
            return Response::responseJson(0, $request['message']);

        return Response::responseJson(1, 'course requested successfully');
    }
}
