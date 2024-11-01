<div class="folder">

    @if(request('targetFolder'))
        <div class="folder-item">
            <div onclick="openFolderByAjax('{{ $lastFolder }}')">
                <div>
                    @include("master-file-manager::file-manager.icons._folder")
                </div>
                <div class="item-name">
                    {{ $lastFolder != '' ? ('Back to').' '. $lastFolder : ('Back to Root') }}
                </div>
                <div class="item-size">
                    --
                    /
                    --
                </div>
            </div>
        </div>
    @endif

    @foreach($folderArray as $folder)
        <div class="folder-item">
            <div onclick="openFolderByAjax('{{ $folder['path'] }}')">
                <div>
                    @include("master-file-manager::file-manager.icons._folder")
                </div>
                <div class="item-name">
                    {{ ucwords(str_replace('-', ' ', str_replace('_', ' ', $folder['name']))) }}
                </div>
                <div class="item-size">
                    {{ $folder['totalFiles'] }} {{ ('Files') }}
                    /
                    {{ $folder['size'] }}
                </div>
            </div>
        </div>
    @endforeach

</div>