<?php

namespace Integrations\MailerLite;

use Illuminate\Support\ServiceProvider;

class MailerLiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/mailerlite.php' => config_path('mailerlite.php')
        ], 'mailerlite');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(config('mailerlite.name'), function () {
            return new MailerLite();
        });
    }
}
