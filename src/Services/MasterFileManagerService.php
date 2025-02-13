<?php

namespace Devrabiul\MasterFileManager\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MasterFileManagerService
{
    public static function getAllFiles($targetFolder = null, object|array $request = null): array
    {
        $GenData = [];
        $request = !empty($request) ? $request : request()->all();
        $targetFolder = !empty($targetFolder) ? $targetFolder : request('targetFolder') ?? '/';
        $AllFilesInCurrentFolder = Storage::disk('public')->files($targetFolder);
        $GenData['path'] = $AllFilesInCurrentFolder;

        $FilesWithInfo = [];
        foreach ($AllFilesInCurrentFolder as $file) {
            $type = explode('/', Storage::disk('public')->mimeType($file))[0];
            $name = explode('/', $file);
            if (!empty($targetFolder) && count($name) > 1) {
                if ((!empty($request['filter']) && $type == $request['filter']) || (empty($request['filter']) || ($request['filter'] == 'all'))) {
                    $FilesWithInfo[] = [
                        'name' => end($name),
                        'short_name' => getFileMinifyString(end($name)),
                        'path' => $file,
                        'encodePath' => Crypt::encryptString($file),
                        'type' => $type,
                        'icon' => self::getIconByExtension(extension: pathinfo($file, PATHINFO_EXTENSION)),
                        'size' => getMasterFileFormatSize(Storage::disk('public')->size($file)),
                        'sizeInInteger' => Storage::disk('public')->size($file),
                        'extension' => pathinfo($file, PATHINFO_EXTENSION),
                        'last_modified' => Carbon::parse(date('Y-m-d H:i:s', Storage::disk('public')->lastModified($file)))->diffForHumans()
                    ];
                }
            }
        }

        $totalFileSize = 0;
        foreach ($AllFilesInCurrentFolder as $file) {
            $totalFileSize += Storage::disk('public')->size($file);
        }

        $GenData['size'] = getMasterFileFormatSize($totalFileSize);
        $GenData['files'] = $FilesWithInfo;
        $GenData['totalFiles'] = count($AllFilesInCurrentFolder);

        $GenData['last_modified'] = Carbon::parse(date('Y-m-d H:i:s', Storage::disk('public')->lastModified('')))->diffForHumans();
        if ($targetFolder && Storage::exists($targetFolder)) {
            $GenData['last_modified'] = Carbon::parse(date('Y-m-d H:i:s', Storage::disk('public')->lastModified($targetFolder)))->diffForHumans();
        }

        return $GenData;
    }

    public static function getAllFolders($targetFolder = null): array
    {
        $allFolders = Storage::disk('public')->allDirectories($targetFolder);
        $onlyFolder = Storage::disk('public')->Directories($targetFolder);
        $folderArray = [];
        foreach ($onlyFolder as $folder) {
            $name = explode('/', $folder);
            $getAllFilesData = self::getAllFiles($folder);
            $folderArray[] = [
                'name' => end($name),
                'path' => $folder,
                'encodePath' => Crypt::encryptString($folder),
                'lastPath' => str_replace(end($name), '', $folder),
                'type' => 'Folder',
                'icon' => self::getIconByExtension(extension: 'folder'),
                'last_modified' => Carbon::parse(date('Y-m-d H:i:s', Storage::disk('public')->lastModified($folder)))->diffForHumans(),
                'totalFiles' => $getAllFilesData['totalFiles'],
                'size' => $getAllFilesData['size'],
                'AllFiles' => $getAllFilesData,
                'AllFolders' => self::getAllFolders($folder),
            ];
        }

        usort($folderArray, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $folderArray;
    }

    public static function getIconByExtension($extension = null): string
    {
        $iconMapping = [
            'folder' => '<i class="fas fa-folder"></i>',
            'jpg' => '<i class="fas fa-image"></i>',
            'jpeg' => '<i class="fas fa-image"></i>',
            'png' => '<i class="fas fa-image"></i>',
            'pdf' => '<i class="fas fa-file-pdf"></i>',
            'zip' => '<i class="far fa-file-archive"></i>',
            'doc' => '<i class="fas fa-file-word"></i>',
            'docx' => '<i class="fas fa-file-word"></i>',
            'xls' => '<i class="fas fa-file-excel"></i>',
            'xlsx' => '<i class="fas fa-file-excel"></i>',
            'ppt' => '<i class="fas fa-file-powerpoint"></i>',
            'pptx' => '<i class="fas fa-file-powerpoint"></i>',
            'txt' => '<i class="fas fa-file-alt"></i>',
            'mp3' => '<i class="fas fa-music"></i>',
            'wav' => '<i class="fas fa-music"></i>',
            'mp4' => '<i class="fas fa-film"></i>',
            'avi' => '<i class="fas fa-film"></i>',
            // Add more file extensions as needed
        ];
        return $iconMapping[$extension] ?? '<i class="fas fa-file"></i>';
    }

    public static function getAllFilesOverview(array $AllFilesWithInfo): array
    {
        $typeImageTotalSize = 0;
        $typeImageCount = 0;
        $typeVideoTotalSize = 0;
        $typeVideoCount = 0;
        $typeAudioTotalSize = 0;
        $typeAudioCount = 0;
        $typeDocTotalSize = 0;
        $typeDocCount = 0;
        $typeOthersTotalSize = 0;
        $typeOthersCount = 0;

        foreach ($AllFilesWithInfo['files'] as $fileName) {
            if ($fileName['type'] == "image") {
                $typeImageTotalSize += $fileName['sizeInInteger'];
                $typeImageCount += 1;
            }

            if ($fileName['type'] == "video") {
                $typeVideoTotalSize += $fileName['sizeInInteger'];
                $typeVideoCount += 1;
            }

            if ($fileName['type'] == "audio") {
                $typeAudioTotalSize += $fileName['sizeInInteger'];
                $typeAudioCount += 1;
            }

            if ($fileName['type'] == "application") {
                $typeDocTotalSize += $fileName['sizeInInteger'];
                $typeDocCount += 1;
            }

            $avoidTypes = ["image", "video", "audio", "application", "text"];
            if (!in_array($fileName['type'], $avoidTypes)) {
                $typeOthersTotalSize += $fileName['sizeInInteger'];
                $typeOthersCount++;
            }
        }

        return [
            'image' => ['size' => getMasterFileFormatSize($typeImageTotalSize), 'count' => $typeImageCount],
            'video' => ['size' => getMasterFileFormatSize($typeVideoTotalSize), 'count' => $typeVideoCount],
            'audio' => ['size' => getMasterFileFormatSize($typeAudioTotalSize), 'count' => $typeAudioCount],
            'others' => ['size' => getMasterFileFormatSize($typeOthersTotalSize), 'count' => $typeOthersCount],
            'document' => ['size' => getMasterFileFormatSize($typeDocTotalSize), 'count' => $typeDocCount],
        ];
    }

    public function getFileInformation($encodePath): array
    {
        $file = Crypt::decryptString($encodePath);
        $name = explode('/', $file);
        return [
            'name' => end($name),
            'short_name' => getFileMinifyString(end($name)),
            'path' => $file,
            'encodePath' => $encodePath,
            'type' => explode('/', Storage::disk('public')->mimeType($file))[0],
            'icon' => self::getIconByExtension(extension: pathinfo($file, PATHINFO_EXTENSION)),
            'size' => getMasterFileFormatSize(Storage::disk('public')->size($file)),
            'sizeInInteger' => Storage::disk('public')->size($file),
            'extension' => pathinfo($file, PATHINFO_EXTENSION),
            'last_modified' => Carbon::parse(date('Y-m-d H:i:s', Storage::disk('public')->lastModified($file)))->diffForHumans()
        ];
    }

    public static function getRecentFiles($limit = 10): array
    {
        $targetFolder = null;
        $allFiles = self::getAllFiles($targetFolder);
        
        // Sort files by last modified time
        usort($allFiles['files'], function($a, $b) {
            $timeA = Storage::disk('public')->lastModified($a['path']);
            $timeB = Storage::disk('public')->lastModified($b['path']);
            return $timeB - $timeA;
        });

        // Get only the specified number of recent files
        $recentFiles = array_slice($allFiles['files'], 0, $limit);
        
        return [
            'files' => $recentFiles,
            'totalFiles' => count($recentFiles),
            'size' => self::calculateTotalSize($recentFiles)
        ];
    }

    public static function getFavoriteFiles(): array
    {
        // Assuming favorites are stored in a JSON file or database
        $favoritesPath = Storage::disk('public')->path('favorites.json');
        $favorites = [];
        
        if (file_exists($favoritesPath)) {
            $favoritesList = json_decode(file_get_contents($favoritesPath), true) ?? [];
            
            foreach ($favoritesList as $filePath) {
                if (Storage::disk('public')->exists($filePath)) {
                    $fileInfo = self::getFileInformation(Crypt::encryptString($filePath));
                    $favorites[] = $fileInfo;
                }
            }
        }
        
        return [
            'files' => $favorites,
            'totalFiles' => count($favorites),
            'size' => self::calculateTotalSize($favorites)
        ];
    }

    private static function calculateTotalSize(array $files): string 
    {
        $totalSize = 0;
        foreach ($files as $file) {
            $totalSize += $file['sizeInInteger'] ?? 0;
        }
        return getMasterFileFormatSize($totalSize);
    }

    public static function toggleFavorite($filePath): bool
    {
        $favoritesPath = Storage::disk('public')->path('favorites.json');
        $favorites = [];
        
        if (file_exists($favoritesPath)) {
            $favorites = json_decode(file_get_contents($favoritesPath), true) ?? [];
        }
        
        $index = array_search($filePath, $favorites);
        if ($index !== false) {
            // Remove from favorites
            unset($favorites[$index]);
            $favorites = array_values($favorites);
        } else {
            // Add to favorites
            $favorites[] = $filePath;
        }
        
        return file_put_contents($favoritesPath, json_encode($favorites)) !== false;
    }

    public static function getQuickAccessFilesByType(string $type, string|null $targetFolder = null): array
    {
        $allFiles = self::getAllFiles($targetFolder, ['filter' => $type]);
        
        return [
            'files' => $allFiles['files'],
            'totalFiles' => count($allFiles['files']),
            'size' => self::calculateTotalSize($allFiles['files'])
        ];
    }

    public static function getQuickAccessStats(): array
    {
        return [
            'recent' => self::getRecentFiles(),
            'favorites' => self::getFavoriteFiles(),
            'images' => self::getQuickAccessFilesByType('image', '/'),
            'videos' => self::getQuickAccessFilesByType('video', '/'),
            'music' => self::getQuickAccessFilesByType('audio', '/'),
            'documents' => self::getQuickAccessFilesByType('application', '/')
        ];
    }
}
