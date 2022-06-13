<?php

namespace Modules\Setting\Providers;

use Setting;
use Spatie\Valuestore\Valuestore;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSetting();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Setting', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
      * Register settings.
     *
     * @return void
     */
    public function registerSetting()
    {
        $this->app->singleton('setting', function () {
            return Valuestore::make(storage_path('app/settings.json'));
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Setting', 'Config/config.php') => config_path('setting.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Setting', 'Config/config.php'), 'setting'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/setting');

        $sourcePath = module_path('Setting', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/setting';
        }, \Config::get('view.paths')), [$sourcePath]), 'setting');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/setting');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'setting');
        } else {
            $this->loadTranslationsFrom(module_path('Setting', 'Resources/lang'), 'setting');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Setting', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
