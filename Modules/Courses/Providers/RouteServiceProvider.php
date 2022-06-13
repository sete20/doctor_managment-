<?php

namespace Modules\Courses\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\Courses\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\Courses\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\Courses\Http\Controllers\Dashboard';
    protected $doctorModule = '\Modules\Courses\Http\Controllers\Doctor';


    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapDashboardRoutes();
        $this->mapDoctorRoutes();
    }


    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(function() {

            foreach (File::allFiles(module_path('Courses', 'Routes/dashboard')) as $file) {
                 require_once($file->getPathname());
            }

        });
    }

    protected function mapDoctorRoutes()
    {
        Route::middleware(config('core.route-middleware.doctor-auth'))
        ->prefix(LaravelLocalization::setLocale().config('core.route-prefix.doctor'))
        ->namespace($this->doctorModule)->group(function() {

            foreach (File::allFiles(module_path('Courses', 'Routes/doctor')) as $file) {
                 require_once($file->getPathname());
            }

        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(function() {

            foreach (File::allFiles(module_path('Courses', 'Routes/frontend')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            foreach (File::allFiles(module_path('Courses', 'Routes/api')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

}
