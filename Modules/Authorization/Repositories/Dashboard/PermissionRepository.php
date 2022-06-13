<?php

namespace Modules\Authorization\Repositories\Dashboard;

use Modules\Authorization\Entities\Permission;
use Lang;
use DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class PermissionRepository extends CrudRepository
{
    function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }
}
