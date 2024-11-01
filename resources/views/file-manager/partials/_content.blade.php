<div class="g-2 h-100 overflow-hidden row">
    <div class="col-12 col-md-2 max-height-100">
        <div class="sidebar-container">
            <div>
                <h4>File Manager</h4>
                <ul class="sidebar-list">
                    <li class="sidebar-item">
                        <a href="#!" class="">
                            @include("master-file-manager::file-manager.icons._folder", ['width' => '20px', 'height' => '20px'])
                            <span class="file-list-link">My Drive</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#!" class="">
                            @include("master-file-manager::file-manager.icons._document", ['width' => '20px', 'height' => '20px'])
                            <span class="file-list-link">Documents</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#!">
                            @include("master-file-manager::file-manager.icons._image", ['width' => '20px', 'height' => '20px'])
                            <span class="file-list-link">Media</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#!">
                            @include("master-file-manager::file-manager.icons._recent", ['width' => '20px', 'height' => '20px'])
                            <span class="file-list-link">Recent</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#!">
                            @include("master-file-manager::file-manager.icons._trash", ['width' => '20px', 'height' => '20px'])
                            <span class="file-list-link">Deleted</span>
                        </a>
                    </li>

                </ul>
            </div>
            @php
                $diskPath = storage_path('app');
                $totalSpace = disk_total_space($diskPath);
                $availableSpace = disk_free_space($diskPath);
            @endphp

            <div class="storage-status-bar">
                <h6 class="fs-11 text-muted text-uppercase mb-3">Storage Status</h6>
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        @include("master-file-manager::file-manager.icons._database")
                    </div>
                    <div class="flex-grow-1 ms-2 overflow-hidden">
                        <div class="progress mb-2 progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{ (int)(($availableSpace*100)/$totalSpace) }}%" aria-valuenow="{{ (int)(($availableSpace*100)/$totalSpace) }}" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <span class="text-muted fs-12 d-block text-truncate">
                        <b>{{ getMasterFileFormatSize($availableSpace) }}</b> used of
                        <b>{{ getMasterFileFormatSize($totalSpace) }}</b>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-10 max-height-100">
        <div class="folder-files-container">
            @include('master-file-manager::file-manager.partials._folder-list')
            @include('master-file-manager::file-manager.partials._file-list')
        </div>
    </div>
</div>