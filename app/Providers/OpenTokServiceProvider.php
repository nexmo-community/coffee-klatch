<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenTok\OpenTok;

class OpenTokServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OpenTok::class, function () {
            // TODO: Create config
            return new OpenTok(config('services.opentok.key'), config('services.opentok.secret'));
        });
    }
}
