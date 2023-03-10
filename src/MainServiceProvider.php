<?php

namespace Lexicon\Goodday;

use Illuminate\Support\ServiceProvider;
use Lexicon\Goodday\Commands\SyncProjects;
use Lexicon\Goodday\Commands\SyncUsers;
use Lexicon\Goodday\Commands\Testing;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() 
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        if($this->app->runningInConsole()) {
            $this->commands([
                SyncUsers::class
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/goodday.php', 'goodday');
    }

}
