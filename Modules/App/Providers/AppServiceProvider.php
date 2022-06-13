<?php

namespace Modules\App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use JanisKelemen\Setting\Facades\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'App';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'app';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $file = module_path('App', 'helpers.php');
        if (file_exists($file)) {
            require_once($file);
        }

        $this->setLocalesConfigurations();
        $this->app->register(RouteServiceProvider::class);
    }


    private function setLocalesConfigurations()
    {
        $defaultLocale = setting('default_locale') ? setting('default_locale') : 'ar';
        $locales       = setting('locales')        ? setting('locales') : ['ar'];
        $rtlLocales    = setting('rtl_locales')    ? setting('rtl_locales') : ['ar'];

        $this->app->config->set([
            'app.locale'                                    => $defaultLocale,
            'app.fallback_locale'                           => $defaultLocale,
            'laravellocalization.supportedLocales'          => $this->supportedLocales($locales),'laravellocalization.useAcceptLanguageHeader'   => true,
            'laravellocalization.hideDefaultLocaleInURL'    => false,
            'default_locale'                                => $defaultLocale,
            'rtl_locales'                                   => $rtlLocales,
            'translatable.locales'                          => $locales,
            'translatable.locale'                           => $defaultLocale,
        ]);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }


    private function supportedLocales($locales)
    {
        return array_intersect_key(config('core.available-locales'), array_flip($locales));
    }
}
