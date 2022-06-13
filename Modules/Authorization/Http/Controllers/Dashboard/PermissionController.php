<?php

namespace Modules\Authorization\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Authorization\Http\Requests\Dashboard\PermissionRequest;
use Modules\Authorization\Transformers\Dashboard\PermissionResource;
use Modules\Authorization\Repositories\Dashboard\PermissionRepository as Permission;

class PermissionController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('authorization::dashboard.permissions.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->permission->QueryTable($request));

        $datatable['data'] = PermissionResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        return view('authorization::dashboard.permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        try {
            $create = $this->permission->create($request);

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
        return view('authorization::dashboard.permissions.show');
    }

    public function edit($id)
    {
        $permission = $this->permission->findById($id);

        return view('authorization::dashboard.permissions.edit',compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        try {
            $update = $this->permission->update($request,$id);

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
            $delete = $this->permission->delete($id);

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
            $deleteSelected = $this->permission->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
