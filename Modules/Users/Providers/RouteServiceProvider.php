<?php

namespace Modules\Users\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use File;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $DashboardNamespace = 'Modules\Users\Http\Controllers\dashboard';
    protected $ApiNamespace = 'Modules\Users\Http\Controllers\Api';
    protected $dashboardModule = '\Modules\Users\Http\Controllers\Dashboard';
    protected $doctorModule = '\Modules\Users\Http\Controllers\Doctor';

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
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapDashboardRoutes();
        $this->mapDoctorRoutes();
    }


    protected function mapDashboardRoutes()
    {
        Route::middleware(config('core.route-middleware.admin-dashboard'))
            ->prefix(LaravelLocalization::setLocale().config('core.route-prefix.admin-dashboard'))
            ->namespace($this->dashboardModule)->group(function() {

                if (File::allFiles(module_path('Users', 'Routes/Dashboard'))) {
                    foreach (File::allFiles(module_path('Users', 'Routes/Dashboard')) as $file) {
                        require_once($file->getPathname());
                    }
                }

            });
    }

    protected function mapDoctorRoutes()
    {
        Route::middleware(config('core.route-middleware.doctor-auth'))
            ->prefix(LaravelLocalization::setLocale().config('core.route-prefix.doctor'))
            ->namespace($this->doctorModule)->group(function() {

                if (File::allFiles(module_path('Users', 'Routes/doctor'))) {
                    foreach (File::allFiles(module_path('Users', 'Routes/doctor')) as $file) {
                        require_once($file->getPathname());
                    }
                }

            });
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
//        Route::middleware('web')
//            ->namespace($this->DashboardNamespace)
//            ->group(module_path('users', '/Routes/dashboard/routes.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/'.config('app.versions.api', 'v1'))
            ->middleware(['api','auth:client'])
            ->namespace($this->ApiNamespace)
            ->group(module_path('users', '/Routes/Api/routes.php'));
    }
}
