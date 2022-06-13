<?php

namespace Modules\Courses\Http\Controllers\Api;

use Helper\Response;
use Illuminate\Http\Request;
use Modules\App\Http\Controllers\Api\ApiController;
use Modules\Courses\Entities\Course;
use Modules\Courses\Transformers\Api\CourseResource;
use Modules\Courses\Repositories\Api\CourseRepository;

class CourseController extends ApiController
{

    private $course;
    private $model;

    function __construct(CourseRepository $course , Course $model)
    {
        $this->course = $course;
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $records = $this->course->getPagination($request);

        return (CourseResource::collection($records))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    public function myCourses(Request $request)
    {
        $records = $this->course->getMyCoursesPagination($request);

        return (CourseResource::collection($records))->additional([
            'status' => 1,
            'message' => 'تم التحميل',
        ]);
    }

    public function LastViewedCource(Request $request)
    {
        $course = $this->course->LastViewedCource($request);

        return $this->response($course ? (new CourseResource($course)) : []);
    }

    public function requestCourse(Request $request)
    {
        $rules = [
            'course_id' => 'required|exists:courses,id'
        ];

        $data = validator()->make($request->all(), $rules,[
            'course_id.required' => 'Course id required',
            'course_id.exists' => 'Course id required',
        ]);

        if ($data->fails())
            return Response::responseJson(0, $data->errors()->first(), $data->errors());

        $course = $this->course->findById($request->course_id);

        if(!$course)
            return Response::responseJson(0, 'course not found');

        $request = $this->course->request($request , $course);

        if(isset($request['status']) && $request['status'] == 0)
            return Response::responseJson(0, $request['message']);

        return Response::responseJson(1,'course requested successfully');
    }
}
