<?php

namespace Modules\Auth\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Auth\Http\Controllers';
    protected $dashboardModule = 'Modules\Auth\Http\Controllers\Dashboard';
    protected $doctorModule = 'Modules\Auth\Http\Controllers\Doctor';

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
        $this->mapDoctorRoutes();

//        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Auth', '/Routes/web.php'));
    }

    protected function mapDashboardRoutes()
    {
        Route::middleware('web', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath', 'localize')
            ->prefix(LaravelLocalization::setLocale() . '/dashboard')
            ->namespace($this->dashboardModule)->group(function () {

                if (File::allFiles(module_path('auth', 'Routes/dashboard'))) {
                    foreach (File::allFiles(module_path('auth', 'Routes/dashboard')) as $file) {
                        require_once($file->getPathname());
                    }
                }

            });
    }

    protected function mapDoctorRoutes()
    {
        Route::middleware('web', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath', 'localize')
            ->prefix(LaravelLocalization::setLocale() . '/doctor')
            ->namespace($this->doctorModule)->group(function () {

                if (File::allFiles(module_path('auth', 'Routes/doctor'))) {
                    foreach (File::allFiles(module_path('auth', 'Routes/doctor')) as $file) {
                        require_once($file->getPathname());
                    }
                }

            });
    }
}
