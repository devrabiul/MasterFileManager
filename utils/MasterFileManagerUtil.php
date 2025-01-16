<?php

use Illuminate\Support\Facades\Cache;

use Devrabiul\MasterFileManager\Services\MasterFileManagerService;
use Illuminate\Contracts\View\View;

if (!function_exists('renderMasterFileManagerView')) {
    function renderMasterFileManagerView(array|object $request = []): View
    {
        $requestData = !empty($request) ? $request : request()->all();
        $targetFolder = urldecode($requestData['targetFolder'] ?? '');

        $cacheKeyFiles = "files_in_{$targetFolder}";
        $cacheKeyFolders = "folders_in_{$targetFolder}";
        $cacheKeyOverview = "overview_in_{$targetFolder}";

        masterFileManagerCacheKeys($cacheKeyFiles);
        masterFileManagerCacheKeys($cacheKeyFolders);
        masterFileManagerCacheKeys($cacheKeyOverview);

        $AllFilesInCurrentFolder = Cache::remember($cacheKeyFiles, 3600, function () use ($targetFolder, $requestData) {
            return MasterFileManagerService::getAllFiles(targetFolder: $targetFolder, request: $requestData);
        });

        $folderArray = Cache::remember($cacheKeyFolders, 3600, function () use ($targetFolder) {
            return MasterFileManagerService::getAllFolders($targetFolder);
        });

        $AllFilesOverview = Cache::remember($cacheKeyOverview, 3600, function () use ($AllFilesInCurrentFolder) {
            return MasterFileManagerService::getAllFilesOverview(AllFilesWithInfo: $AllFilesInCurrentFolder);
        });

        $lastFolderArray = explode('/', $targetFolder);
        $lastFolder = count($lastFolderArray) > 1 ? str_replace('/' . end($lastFolderArray), '', $targetFolder) : '';

        return view('master-file-manager::file-manager.partials.container', [
            'folderArray' => $folderArray,
            'AllFilesInCurrentFolder' => $AllFilesInCurrentFolder,
            'lastFolder' => $lastFolder,
            'AllFilesOverview' => $AllFilesOverview
        ]);
    }
}

if (!function_exists('renderMasterFileManagerStyle')) {
    function renderMasterFileManagerStyle()
    {
        return view('master-file-manager::file-manager.partials._style');
    }
}

if (!function_exists('renderMasterFileManagerJavaScript')) {
    function renderMasterFileManagerJavaScript()
    {
        return view('master-file-manager::file-manager.partials._script');
    }
}

if (!function_exists('getFileMinifyString')) {
    function getFileMinifyString($inputString, $prefixLength = 15, $suffixLength = 8, $ellipsis = '.....')
    {
        if (strlen($inputString) <= $prefixLength + $suffixLength) {
            return $inputString;
        }
        $prefix = substr($inputString, 0, $prefixLength);
        $suffix = substr($inputString, -$suffixLength);
        return $prefix . $ellipsis . $suffix;
    }
}

if (!function_exists('getMasterFileFormatSize')) {
    function getMasterFileFormatSize($size = 0): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $unitIndex = 0;
        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }

        return round($size, 2) . ' ' . $units[$unitIndex];
    }
}

if (!function_exists('masterFileManagerAsset')) {
    function masterFileManagerAsset(string $path): string
    {
        if (config('master-file-manager.system_processing_directory') == 'public') {
            $result = str_replace('storage/app/public', 'storage', $path);
        } else {
            $result = $path;
        }
        return asset($result);
    }
}


if (!function_exists('masterFileManagerCacheKeys')) {
    function masterFileManagerCacheKeys($cacheKey): void
    {
        $cacheKeys = Cache::get('masterFileManagerCacheKeys', []);
        if (!in_array($cacheKey, $cacheKeys)) {
            $cacheKeys[] = $cacheKey;
            Cache::put('masterFileManagerCacheKeys', $cacheKeys, 60 * 60 * 3);
        }
    }
}

