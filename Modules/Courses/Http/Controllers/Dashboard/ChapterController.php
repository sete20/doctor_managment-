<?php

namespace Modules\Courses\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Modules\Courses\Entities\Chapter;
use Modules\Core\Traits\DataTable;
use Illuminate\Routing\Controller;
use Modules\Courses\Http\Requests\Dashboard\ChapterRequest;
use Modules\Courses\Transformers\Dashboard\ChapterResource;
use Modules\Courses\Repositories\Dashboard\ChapterRepository;

class ChapterController extends Controller
{
    private $chapter;
    private $model;

    function __construct(ChapterRepository $chapter , Chapter $model)
    {
        $this->chapter = $chapter;
        $this->model = $model;
    }

    public function index()
    {
        return view('courses::dashboard.chapters.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->chapter->QueryTable($request));

        $datatable['data'] = ChapterResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $model = $this->model;
        return view('courses::dashboard.chapters.create' , compact('model'));
    }

    public function store(ChapterRequest $request)
    {
        try {
            $create = $this->chapter->create($request);

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
        return view('courses::dashboard.chapters.show');
    }

    public function edit($id)
    {
        $model = $this->chapter->findById($id);
        return view('courses::dashboard.chapters.edit',compact('model'));
    }

    public function update(ChapterRequest $request, $id)
    {
        try {
            $update = $this->chapter->update($request,$id);

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
            $delete = $this->chapter->delete($id);

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
            $deleteSelected = $this->chapter->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }



    public function deleteAttachment($model ,$collection, $media)
    {
        try {
            $delete = $this->chapter->deleteAttachment($model ,$collection, $media);

            if ($delete) {
                return Response()->json([true , 'تم الحذف']);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
