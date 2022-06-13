<?php

namespace Modules\Authorization\ViewComposers\Dashboard;

use Modules\Authorization\Repositories\Dashboard\RoleRepository as Role;
use Illuminate\View\View;
use Cache;

class AdminRolesComposer
{
    public $roles = [];

    public function __construct(Role $role)
    {
        $this->roles =  $role->getAllAdminsRoles();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roles' , $this->roles);
    }
}
