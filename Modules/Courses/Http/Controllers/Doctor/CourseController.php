<?php

namespace Modules\Courses\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Courses\Entities\Course;
use Modules\Core\Traits\DataTable;
use Illuminate\Routing\Controller;
use Modules\Courses\Http\Requests\Doctor\CourseRequest;
use Modules\Courses\Transformers\Doctor\CourseResource;
use Modules\Courses\Repositories\Doctor\CourseRepository;

class CourseController extends Controller
{
    private $course;
    private $model;

    function __construct(CourseRepository $course , Course $model)
    {
        $this->course = $course;
        $this->model = $model;
    }

    public function index()
    {
        return view('courses::doctor.courses.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->course->QueryTable($request));

        $datatable['data'] = CourseResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $model = $this->model;
        return view('courses::doctor.courses.create' , compact('model'));
    }

    public function store(CourseRequest $request)
    {
        try {
            $create = $this->course->create($request);

            if ($create) {
                return Response()->json([true , __('app::dashboard.messages.created')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return view('courses::doctor.courses.show');
    }

    public function edit($id)
    {
        $model = $this->course->findById($id);
        return view('courses::doctor.courses.edit',compact('model'));
    }

    public function update(CourseRequest $request, $id)
    {
        try {
            $update = $this->course->update($request,$id);

            if ($update) {
                return Response()->json([true , __('app::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->course->delete($id);

            if ($delete) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->course->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
