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
        $targetFolder = !empty($targetFolder) ? $targetFolder : request('targetFolder');
        $AllFilesInCurrentFolder = Storage::disk('public')->allFiles($targetFolder);
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

}
