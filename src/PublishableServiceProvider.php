<?php
namespace BrandStudio\Publishable;

use Illuminate\Support\ServiceProvider;

class PublishableServiceProvider extends ServiceProvider
{

    public function register()
    {

        if ($this->app->runningInConsole()) {
            $this->publish();
        }

    }

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'publishable');

        if ($this->app->runningInConsole()) {
            $this->publish();
        }
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/resources/lang'      => resource_path('lang/vendor/brandstudio')
        ], 'lang');

    }

}
