<?php
    use Devrabiul\MasterFileManager\Services\MasterFileManagerService;
    use Illuminate\Support\Facades\Cache;

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

    $recentFiles = MasterFileManagerService::getRecentFiles();
    $favoriteFiles = MasterFileManagerService::getFavoriteFiles();
    $quickAccess = MasterFileManagerService::getQuickAccessStats();

    $lastFolderArray = explode('/', $targetFolder);
    $lastFolder = count($lastFolderArray) > 1 ? str_replace('/' . end($lastFolderArray), '', $targetFolder) : '';
?>
<div class="file-manager-root-container">

    <!-- Header Container | Start -->
    <section class="file-manager-header">
        <div class="header-left">
            <button id="sidebarToggle" class="sidebar-toggle">
                <i class="bi bi-list"></i>
            </button>
            <h4>File Manager</h4>
        </div>

        <div class="header-right">
            <div class="search-container">
                <i class="bi bi-search"></i>
                <input type="search" placeholder="Search files, folders">
            </div>

            <button id="createBtn" class="upload-btn">
                <i class="bi bi-plus"></i>
                <span>Upload</span>
            </button>
        </div>
    </section>
    <!-- Header Container | End -->

    <!-- Main Container | Start -->
    <section class="file-manager-main-container temp-border">

        <!-- Sidebar Container | Start -->
        @include('master-file-manager::partials._sidebar')
        <!-- Sidebar Container | End -->

        <!-- Files Container | Start -->
        <section class="file-manager-files-container temp-border" data-route="{{ route('master-file-manager.folder-content') }}">
            <div class="master-file-manager-loader-container loader-container-hide">
                <div class="loader">
                    <div class="loader-circle"></div>
                    <div class="loader-text">Loading...</div>
                </div>
            </div>

            <div class="master-file-manager-content">
                @include('master-file-manager::partials._content')
            </div>        

        </section>
        <!-- Files Container | End -->

    </section>
    <!-- Main Container | End -->

    <!-- Add this before the closing body tag -->
    <div class="modal-overlay" id="createModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Upload Files</h5>
                <button class="close-modal"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="upload-area">
                    <div class="filepond-wrapper">
                        <input type="file" class="filepond" name="files" multiple>
                    </div>
                </div>
            </div>
            <div class="upload-actions">
                <button type="button" class="btn-cancel">Cancel</button>
                <button type="button" class="btn-upload">
                    <i class="bi bi-cloud-arrow-up"></i>
                    Upload
                </button>
            </div>
        </div>
    </div>

</div>
