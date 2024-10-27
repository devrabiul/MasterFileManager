<?php

namespace Devrabiul\MasterFileManager\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EmptyTrash extends Command
{
    protected $signature = 'file-manager:trash-empty';
    protected $description = 'Empty the trash folder';

    public function handle()
    {
        // Define the path to the trash folder
        $trashPath = storage_path('app/public/trash'); // Adjust this path as needed

        if (!File::exists($trashPath)) {
            $this->error('Trash folder does not exist.');

            File::makeDirectory($trashPath);
            $this->info('Trash create successfully.');
        }

        // Get all files and directories in the trash folder
        $files = File::allFiles($trashPath);

        // Delete each file
        foreach ($files as $file) {
            File::delete($file);
        }

        // Optionally, delete any empty directories
        File::cleanDirectory($trashPath);

        $this->info('Trash folder emptied successfully.');
        return 0; // Indicate success
    }
}
