<?php

namespace Modules\Category\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use File;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\Category\Http\Controllers\Api';
    protected $dashboardModule = '\Modules\Category\Http\Controllers\Dashboard';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapDashboardRoutes();

        $this->mapApiRoutes();
    }

    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
            ->prefix(LaravelLocalization::setLocale().'/dashboard')
            ->namespace($this->dashboardModule)->group(function() {

                foreach (File::allFiles(module_path('Category', 'Routes/dashboard')) as $file) {
                    require_once($file->getPathname());
                }

            });
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],function() {

            foreach (File::allFiles(module_path('Category', 'Routes/api')) as $file) {
                require_once($file->getPathname());
            }

        });
    }

}
