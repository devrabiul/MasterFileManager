<?php


use Devrabiul\MasterFileManager\Services\MasterFileManagerService;
use Illuminate\Contracts\View\View;

if (!function_exists('renderMasterFileManagerView')) {
    function renderMasterFileManagerView(array|object $request = []): View
    {
        $requestData = !empty($request) ? $request : request()->all();
        $targetFolder = urldecode($requestData['targetFolder'] ?? '');
        $AllFilesInCurrentFolder = MasterFileManagerService::getAllfiles(targetFolder: $targetFolder, request: $requestData);
        $folderArray = MasterFileManagerService::getAllFolders($targetFolder);
        $lastFolderArray = explode('/', $targetFolder);
        $lastFolder = count($lastFolderArray) > 1 ? str_replace('/' . end($lastFolderArray), '', $targetFolder) : '';
        $AllFilesOverview = MasterFileManagerService::getAllFilesOverview(AllFilesWithInfo: $AllFilesInCurrentFolder);

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