<?php

namespace Modules\Authorization\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Authorization\Repositories\Dashboard\PermissionRepository;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class RoleController extends Controller
{
    use CrudDashboardController{
        CrudDashboardController::__construct as private CrudConstruct;
    }

    private $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->CrudConstruct();
        $this->permission = $permission;
    }

    public function create()
    {
        $permissions = $this->permission->getAll('category');
        return $this->view('create' , compact('permissions'));
    }

    public function edit($id)
    {
        $role = $this->repository->findById($id);
        $permissions = $this->permission->getAll('category');
        return $this->view('edit' , compact('permissions','role'));
    }

}
