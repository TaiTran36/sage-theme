<?php

namespace App\Providers;

use App\Console\Commands\SeedCommand;
use Roots\Acorn\Application;
class AppServiceProvider
{
    public function register(Application $app): void
    {
        if ($app->runningInConsole()) {
            $app->commands([SeedCommand::class,]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
