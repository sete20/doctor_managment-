<?php

namespace Modules\App\Providers;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $DashboardNamespace = 'Modules\App\Http\Controllers\Dashboard';
    protected $DoctorNamespace = 'Modules\App\Http\Controllers\Doctor';
    protected $ApiNamespace = 'Modules\App\Http\Controllers\Api';

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
        $this->mapDoctorRoutes();
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
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize','auth:admin')
            ->prefix(LaravelLocalization::setLocale().'/dashboard')
            ->namespace($this->DashboardNamespace)
            ->group(module_path('app', '/Routes/Dashboard/routes.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapDoctorRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize','auth:doctor')
            ->prefix(LaravelLocalization::setLocale().'/doctor')
            ->namespace($this->DoctorNamespace)
            ->group(module_path('app', '/Routes/Doctor/routes.php'));
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
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->ApiNamespace)
            ->group(module_path('app', '/Routes/Api/routes.php'));
    }
}
