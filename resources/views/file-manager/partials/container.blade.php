<div>
    @forelse(range(1, 30) as $fileItem)
        <div>
            <div>
                <i class="bi bi-folder-fill"></i>
            </div>
            <div>
                {{ $fileItem }}
            </div>
        </div>
    @empty
        <div>
            <div>
                <i class="bi bi-folder-fill"></i>
            </div>
            <div>
                No Items
            </div>
        </div>
    @endforelse
</div>