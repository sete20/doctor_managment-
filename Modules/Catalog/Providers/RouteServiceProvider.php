<?php

namespace Modules\Catalog\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\Catalog\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\Catalog\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\Catalog\Http\Controllers\Dashboard';


    protected function mapDashboardRoutes()
    {
        Route::middleware(config('core.route-middleware.admin-dashboard'))
        ->prefix(LaravelLocalization::setLocale().config('core.route-prefix.admin-dashboard'))
        ->namespace($this->dashboardModule)->group(function() {

            foreach (File::allFiles(module_path('Catalog', 'Routes/dashboard')) as $file) {
                 require_once($file->getPathname());
            }

        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(function() {

            foreach (File::allFiles(module_path('Catalog', 'Routes/frontend')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            foreach (File::allFiles(module_path('Catalog', 'Routes/api')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

}
