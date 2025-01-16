<?php

namespace Devrabiul\MasterFileManager;

use Devrabiul\MasterFileManager\Console\EmptyTrash;
use Illuminate\Support\ServiceProvider;

class MasterFileManagerServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        // Set the SYSTEM_PROCESSING_DIRECTORY value
        $fileContent = file_get_contents('index.php');
        if (preg_match('/const SYSTEM_PROCESSING_DIRECTORY = \'(.*?)\';/', $fileContent, $matches)) {
            $systemProcessingDirectory = $matches[1];
        } else {
            $systemProcessingDirectory = 'root';
        }
        // Update the configuration
        config(['master-file-manager.system_processing_directory' => $systemProcessingDirectory]);

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
        // Define the publishing path for the views
        $publishPath = resource_path('views/vendor/master-file-manager');

        // Check if the views already exist, and if so, remove them
        if (is_dir($publishPath)) {
            $this->deleteDirectory($publishPath);
        }

        $this->publishes([
            __DIR__.'/../config/master-file-manager.php' => config_path('master-file-manager.php'),
            __DIR__.'/../resources/views' => $publishPath,
        ]);
    }

    /**
     * Recursively delete a directory.
     *
     * @param string $dir
     * @return void
     */
    private function deleteDirectory($dir)
    {
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            $itemPath = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($itemPath)) {
                $this->deleteDirectory($itemPath);
            } else {
                unlink($itemPath);
            }
        }
        rmdir($dir);
    }

}