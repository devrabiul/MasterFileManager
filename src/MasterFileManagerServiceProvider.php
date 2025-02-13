<?php

namespace Devrabiul\MasterFileManager;

use Devrabiul\MasterFileManager\Console\EmptyTrash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MasterFileManagerServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->updateProcessingDirectoryConfig();

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
            $this->copyPublicAssets(); // Manually copy assets
        }
        $this->registerResources();
    }

    public function register()
    {

    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . './../database/migrations');
        $this->loadRoutesFrom(__DIR__ . './../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'master-file-manager');
        $this->commands($this->registerCommands());
    }

    private function registerCommands()
    {
        return [
            EmptyTrash::class,
        ];
    }

    private function registerPublishing(): void
    {
        $viewsPath = resource_path('views/vendor/master-file-manager');

        // Publish assets, config, and views with separate tags
        $this->publishes([
            __DIR__ . '/../config/master-file-manager.php' => config_path('master-file-manager.php'),
        ], 'master-file-manager-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => $viewsPath,
        ], 'master-file-manager-views');

        // Publish all assets with a single tag
        $this->publishes([
            __DIR__ . '/../config/master-file-manager.php' => config_path('master-file-manager.php'),
            __DIR__ . '/../resources/views' => $viewsPath,
        ], 'master-file-manager');
    }

    private function copyPublicAssets(): void
    {
        $packagePublicPath = __DIR__ . '/../src/assets';
        $publicPath = public_path('vendor/devrabiul/master-file-manager/assets');

        // Ensure the package's public folder exists
        if (!is_dir($packagePublicPath)) {
            \Log::error("MasterFileManager: Public assets directory not found at $packagePublicPath");
            return;
        }

        // Clean existing directory before copying
        if (is_dir($publicPath)) {
            File::deleteDirectory($publicPath);
        }

        // Copy files from package to public/vendor/devrabiul/master-file-manager
        File::copyDirectory($packagePublicPath, $publicPath);

        \Log::info("MasterFileManager: Public assets copied successfully.");
    }

    private function updateProcessingDirectoryConfig(): void
    {
        // Get the current script's directory
        $scriptPath = realpath(dirname($_SERVER['SCRIPT_FILENAME']));

        // Get Laravel base and public paths
        $basePath = realpath(base_path());
        $publicPath = realpath(public_path());

        // Determine where the script is running from
        if ($scriptPath === $publicPath) {
            $systemProcessingDirectory = 'public';
        } elseif ($scriptPath === $basePath) {
            $systemProcessingDirectory = 'root';
        } else {
            $systemProcessingDirectory = 'unknown';
        }

        // Update the configuration
        config(['master-file-manager.system_processing_directory' => $systemProcessingDirectory]);
    }


    private function deleteDirectory(string $dir): void
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
