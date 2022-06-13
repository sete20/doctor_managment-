<?php

namespace Modules\Setting\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
     protected $apiModule       = '\Modules\Setting\Http\Controllers\Api';
     protected $frontendModule  = '\Modules\Setting\Http\Controllers\Frontend';
     protected $dashboardModule = '\Modules\Setting\Http\Controllers\Dashboard';

    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            if (File::allFiles(module_path('Setting', 'Routes/dashboard'))) {
                foreach (File::allFiles(module_path('Setting', 'Routes/dashboard')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }


    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(function() {

            if (File::allFiles(module_path('Setting', 'Routes/frontend'))) {
                foreach (File::allFiles(module_path('Setting', 'Routes/frontend')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            if (File::allFiles(module_path('Setting', 'Routes/api'))) {
                foreach (File::allFiles(module_path('Setting', 'Routes/api')) as $file) {
                    require_once($file->getPathname());
                }
            }

        });
    }
}
