<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $file = module_path('Core', 'helpers.php');

        if (file_exists($file)) {
            require_once($file);
        }

        $this->setSettingConfigurations();
        $this->setApiSettingConfigurations();
        $this->setLocalesConfigurations();
    }

    public function boot()
    {

    }

    private function setLocalesConfigurations()
    {
          $defaultLocale = setting('default_locale') ? setting('default_locale') : 'en';
          $locales       = setting('locales')        ? setting('locales') : ['en'];
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


    private function setApiSettingConfigurations()
    {
          $this->app->config->set([
            'api_setting'     => [
                'social_media'          => setting('social'),
                'contact_us'            => setting('contact_us'),
                'other'                 => setting('other'),
                'currencies'            => setting('currencies'),
                'default_currency'      => setting('default_currency')
              ]
          ]);
    }

    private function setSettingConfigurations()
    {
        $this->app->config->set([
            'app.name'  => setting('app_name',locale()),
        ]);
    }

    private function supportedLocales($locales)
    {
        return array_intersect_key(config('core.available-locales'), array_flip($locales));
    }
}
