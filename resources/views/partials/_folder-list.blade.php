<div>
    <h5 class="folders-section-title">
        <span><i class="bi bi-folder-fill"></i></span>
        <span>Folders</span>
    </h5>
    <p class="folders-section-subtitle">Manage your folders easily</p>
</div>
<div class="file-manager-folders-section">
    @if(request('targetFolder'))    
    <div class="file-manager-folder-item" onclick="openFolderByAjax('')">
        <div class="folder-icon folder-icon-back">
            <img src="{{ masterFileManagerAsset('assets/images/return-back.svg') }}" alt="" srcset="" class="svg">
        </div>
        <div class="folder-title">
            Back to Root
        </div>

        <div class="folder-info">
            --
        </div>

        <div class="files-option-element" onclick="event.stopPropagation()">
            <button class="menu-dot" onclick="toggleDropdown(event, this)">
                <i class="bi bi-three-dots"></i>
            </button>
        </div>
    </div>
    @endif
    @foreach($folderArray as $folder)
        <div class="file-manager-folder-item" 
             onclick="openFolderByAjax('{{ $folder['path'] }}')"
             role="button"
             style="cursor: pointer;">
            <div class="folder-icon">
                <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="" class="svg">
            </div>
            <div class="folder-title">
                {{ ucwords(str_replace('-', ' ', str_replace('_', ' ', $folder['name']))) }}
            </div>

            <div class="folder-info">
                {{ $folder['totalFiles'] }} {{ ('Files') }}
                /
                {{ $folder['size'] }}
            </div>

            <div class="files-option-element" onclick="event.stopPropagation()">
                <button class="menu-dot" onclick="toggleDropdown(event, this)">
                    <i class="bi bi-three-dots"></i>
                </button>
                <div class="files-dropdown-menu">
                    <a href="#" onclick="openFolderByAjax('{{ $folder['path'] }}')">
                        <i class="bi bi-folder2-open"></i> Open
                    </a>
                    <a href="#" onclick="renameFolder('{{ $folder['path'] }}')">
                        <i class="bi bi-pencil"></i> Rename
                    </a>
                    <a href="#" onclick="copyFolder('{{ $folder['path'] }}')">
                        <i class="bi bi-files"></i> Copy
                    </a>
                    <a href="#" onclick="moveFolder('{{ $folder['path'] }}')">
                        <i class="bi bi-arrows-move"></i> Move
                    </a>
                    <a href="#" onclick="getFolderInfo('{{ $folder['path'] }}')" class="info-option">
                        <i class="bi bi-info-circle"></i> Get Info
                    </a>
                    <a href="#" onclick="deleteFolder('{{ $folder['path'] }}')" class="delete-option">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    
</div>