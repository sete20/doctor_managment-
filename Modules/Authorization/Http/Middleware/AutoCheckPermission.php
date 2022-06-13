<?php

namespace Modules\Authorization\Http\Middleware;

use Closure;
use Modules\Authorization\Entities\Permission;

class AutoCheckPermission
{
    private $actions = [
        'create' => 'add',
        'store' => 'add',
        'edit' => 'edit',
        'update' => 'edit',
        'deletes' => 'deletes',
        'destroy' => 'destroy',
        'index' => 'show',
        'datatable' => 'show',
        'show' => 'show',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->route()->getName();
        $permission = Permission::whereRaw("FIND_IN_SET('$route',routes)")->first();

        if($permission) {
            if(!auth()->user()->can($permission->name))
            {
                abort(403);
            }
        }
        return $next($request);
    }

    private function buildPermissionName($request){

        $route = explode('.',$request->route()->getName());

        if(isset($route)){

            if(!isset($route[2]))
                return false;

            $fetcher =  $route[2];
            $action =  $route[count($route) - 1];
            $action =  array_key_exists($action , $this->actions) ? $this->actions[$action] : $action;
            return $fetcher.'_'.$action;
        }

        return false;
    }

}
