<div class="master-file-manager">
    <div class="folder">
        @forelse(range(1, 30) as $fileItem)
            <div class="folder-item">
                <div>
                    @include("master-file-manager::file-manager.icons._folder")
                </div>
                <div>
                    {{ $fileItem }}
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