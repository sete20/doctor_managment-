<?php

namespace Modules\Category\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\DataTable;
use Illuminate\Routing\Controller;
use Modules\Category\Http\Requests\Dashboard\CategoryRequest;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Category\Repositories\Dashboard\CategoryRepository;

class CategoryController extends Controller
{
    private $category;
    private $model;

    function __construct(CategoryRepository $category , Category $model)
    {
        $this->category = $category;
        $this->model = $model;
    }

    public function index()
    {
        return view('category::dashboard.categories.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->category->QueryTable($request));

        $datatable['data'] = CategoryResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $model = $this->model;
        $mainCategories = $this->category->mainCategories();
        return view('category::dashboard.categories.create' , compact('mainCategories','model'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $create = $this->category->create($request);

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
        return view('category::dashboard.categories.show');
    }

    public function edit($id)
    {
        $model = $this->category->findById($id);
        $mainCategories = $this->category->mainCategories();

        return view('category::dashboard.categories.edit',compact('model','mainCategories'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $update = $this->category->update($request,$id);

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
            $delete = $this->category->delete($id);

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
            $deleteSelected = $this->category->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
