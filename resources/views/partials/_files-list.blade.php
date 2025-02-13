<div class="files-header">
    <div class="files-header-title">
        <h5 class="folders-section-title">
            <span><i class="bi bi-grid-fill"></i></span>
            <span>Files</span>
        </h5>
        <p class="folders-section-subtitle">Browse and organize your files effortlessly</p>
    </div>
    
    <!-- Add search input -->
    <div class="search-container">
        <div class="search-wrapper">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="fileSearch" class="file-search-input" placeholder="Search files...">
        </div>
    </div>
</div>

@if(count($AllFilesInCurrentFolder['files']) > 0)
    <div class="file-manager-files-section" id="filesContainer">
        @foreach ($AllFilesInCurrentFolder['files'] as $key => $File)
        <div class="file-manager-files-item" data-filename="{{ strtolower($File['short_name']) }}">
            <div class="files-icon" onclick="previewFile('{{ $File['type'] }}', '{{ $File['path'] }}', '{{ $File['short_name'] }}')">
                @if ($File['type'] == 'image')
                    <img src="{{ masterFileManagerStorage('storage/app/public/'.$File['path']) }}" alt="" srcset="" class="image-file">
                @elseif($File['type'] == 'video')
                    <img src="{{ masterFileManagerAsset('assets/images/video.svg') }}" alt="" srcset="">
                @else
                    <img src="{{ masterFileManagerAsset('assets/images/zip.svg') }}" alt="" srcset="">
                @endif
            </div>
            <div class="files-information">
                <div class="files-title">
                    {{ $File['short_name'] }}
                </div>

                <div class="files-info">
                    {{ ucwords($File['type'] ?? 'Others') }} / {{ $File['size'] }}
                    <br>
                    {{ $File['last_modified'] }}
                </div>
            </div>

            <div class="files-option-element">
                <button class="menu-dot" onclick="toggleDropdown(event, this)">
                    <i class="bi bi-three-dots"></i>
                </button>
                <div class="files-dropdown-menu">
                    <a href="#" onclick="openFile('{{ $File['path'] }}')">
                        <i class="bi bi-eye"></i> Open
                    </a>
                    <a href="#" onclick="renameFile('{{ $File['path'] }}')">
                        <i class="bi bi-pencil"></i> Rename
                    </a>
                    <a href="#" onclick="copyFile('{{ $File['path'] }}')">
                        <i class="bi bi-files"></i> Copy
                    </a>
                    <a href="#" onclick="moveFile('{{ $File['path'] }}')">
                        <i class="bi bi-arrows-move"></i> Move
                    </a>
                    <a href="{{ masterFileManagerStorage('storage/app/public/'.$File['path']) }}" download>
                        <i class="bi bi-download"></i> Download
                    </a>
                    <a href="#" onclick="getFileInfo('{{ $File['path'] }}')" class="info-option">
                        <i class="bi bi-info-circle"></i> Get Info
                    </a>
                    <a href="#" onclick="deleteFile('{{ $File['path'] }}')" class="delete-option">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="file-manager-empty-state">
        <div class="empty-state-content">
            <i class="bi bi-folder-x"></i>
            <h3>No Files Found</h3>
            <p>This folder is empty. Upload some files to get started!</p>
            <button class="upload-btn">
                <i class="bi bi-cloud-upload"></i>
                Upload Files
            </button>
        </div>
    </div>
@endif

<div class="search-results-empty-state-container">

</div>

<!-- Image Viewer Modal -->
<div id="imageViewerModal" class="master-file-manager-modal">
    <div class="master-file-manager-modal-content">
        <span class="master-file-manager-modal-close">&times;</span>
        <img id="modalImage" src="" alt="">
    </div>
</div>

<!-- File Info Modal -->
<div id="fileInfoModal" class="master-file-manager-modal">
    <div class="master-file-manager-modal-content">
        <span class="master-file-manager-modal-close">&times;</span>
        <div class="master-file-manager-file-info-content">
            <h3 id="fileInfoTitle"></h3>
            <div id="fileInfoDetails"></div>
        </div>
    </div>
</div>