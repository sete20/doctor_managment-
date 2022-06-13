<?php

namespace Modules\Users\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Users\Http\Requests\Dashboard\AdminRequest;
use Modules\Users\Transformers\Dashboard\AdminResource;
use Modules\Users\Repositories\Dashboard\AdminRepository as Admin;
use Modules\Authorization\Repositories\Dashboard\RoleRepository as Role;

class AdminController extends Controller
{

    function __construct(Admin $admin , Role $role)
    {
        $this->role = $role;
        $this->admin = $admin;
    }

    public function index()
    {
        $roles = $this->role->getAllAdminsRoles('id','asc');
        return view('users::dashboard.admins.index',compact('roles'));
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->admin->QueryTable($request));

        $datatable['data'] = AdminResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $roles = $this->role->getAllAdminsRoles('id','asc');
        return view('users::dashboard.admins.create',compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        try {
            $create = $this->admin->create($request);

            if ($create) {
                return Response()->json([true , __('app::dashboard.messages.created')]);
            }

            return Response()->json([true , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        abort(404);
        return view('users::dashboard.admins.show');
    }

    public function edit($id)
    {
        $user = $this->admin->findById($id);
        $roles = $this->role->getAllAdminsRoles('id','asc');

        return view('users::dashboard.admins.edit',compact('user','roles'));
    }

    public function update(AdminRequest $request, $id)
    {
        try {
            $update = $this->admin->update($request,$id);

            if ($update) {
              return Response()->json([true , __('app::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->admin->delete($id);

            if ($delete) {
              return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->admin->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
