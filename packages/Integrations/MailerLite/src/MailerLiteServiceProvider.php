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
            __DIR__ . '/config/mailerLite.php' => config_path('mailerLite.php')
        ], 'mailerLite');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(config('mailerLite.name'), function () {
            return new MailerLite();
        });
    }
}
