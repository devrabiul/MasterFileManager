<?php

namespace Devrabiul\MasterFileManager;

use Devrabiul\MasterFileManager\Console\EmptyTrash;
use Illuminate\Support\ServiceProvider;

class MasterFileManagerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
         $this->registerResources();
    }

    public function register()
    {

    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'./../database/migrations');
        $this->loadRoutesFrom(__DIR__.'./../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'master-file-manager');
        $this->commands($this->registerCommands());
    }

    private function registerCommands()
    {
        return [
            EmptyTrash::class,
        ];
    }

    private function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/master-file-manager.php' => config_path('master-file-manager.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/master-file-manager'),
        ]);
    }

}