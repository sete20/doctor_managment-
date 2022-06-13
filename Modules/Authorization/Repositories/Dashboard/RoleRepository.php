<?php

namespace Modules\Authorization\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Authorization\Entities\Role;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Illuminate\Support\Facades\DB;

class RoleRepository extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(Role::class);
    }

    public function getAllAdminsRoles($order = 'id', $sort = 'desc')
    {
        $roles = $this->model->whereHas('permissions', function($query){
                    $query->where('name','dashboard_access');
                 })->orderBy($order, $sort)->get();
        return $roles;
    }

    public function getAllCompanyOwnersRoles($order = 'id', $sort = 'desc')
    {
        $roles = $this->model->whereHas('perms', function($query){
                    $query->where('name','company_dashboard_access');
                 })->orderBy($order, $sort)->get();
        return $roles;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {

            $role = $this->model->create($request->except('permission'));
            $role->permissions()->attach($request->permission);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();

        try {

            $role = $this->findById($id);

            $role->update([
              'name'                => $request->name,
            ]);

            $role->update($request->except('permission'));
            $role->permissions()->sync($request->permission);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}
