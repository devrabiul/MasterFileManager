<div class="master-file-manager">
    <div class="folder">
        @forelse ($folderArray as $folder)
            <div class="folder-item">
                <div>
                    @include("master-file-manager::file-manager.icons._folder")
                </div>
                <div>
                    {{ ucwords(str_replace('_', ' ', $folder['name'])) }}
                </div>
                <div>
                    {{ $folder['totalFiles'] }} {{ ('Files') }}
                    /
                    {{ $folder['size'] }}
                </div>
            </div>
        @empty
            <div class="folder-item">
                <div>
                    @include("master-file-manager::file-manager.icons._folder")
                </div>
                <div>
                    No Items
                </div>
            </div>
        @endforelse


        @forelse ($AllFilesInCurrentFolder['files'] as $key => $File)
            <div class="folder-item">
                <div>
                    @if ($File['type'] == 'image')
                        @include("master-file-manager::file-manager.icons._image")
                    @elseif($File['type'] == 'video')
                        @include("master-file-manager::file-manager.icons._video")
                    @else
                        @include("master-file-manager::file-manager.icons._document")
                    @endif
                </div>
                <div>
                    {{ ucwords(str_replace('_', ' ', $folder['name'])) }}
                </div>
                <div>
                    {{ $folder['totalFiles'] }} {{ ('Files') }}
                    /
                    {{ $folder['size'] }}
                </div>
            </div>
        @empty
            <div class="folder-item">
                <div>
                    @include("master-file-manager::file-manager.icons._folder")
                </div>
                <div>
                    No Items
                </div>
            </div>
        @endforelse
    </div>
</div>