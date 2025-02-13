<section class="file-manager-sidebar-container">
    <button class="sidebar-close-mobile">
        <i class="bi bi-x-lg"></i>
    </button>
    
    <!-- Quick Access -->
    <h5 class="quick-access-section-title">Quick Access</h5>
    <div class="quick-access-section">
        <div class="quick-access-items">
            <a href="#" class="quick-access-item" data-type="recent">
                <div class="quick-access-content">
                    <i class="bi bi-clock-history"></i>
                    <span>Recent Files</span>
                </div>
                <span class="type-size">{{ $quickAccess['recent']['totalFiles'] }} files</span>
            </a>
            <a href="#" class="quick-access-item" data-type="favorites">
                <div class="quick-access-content">
                    <i class="bi bi-star"></i>
                    <span>Favorites</span>
                </div>
                <span class="type-size">{{ $quickAccess['favorites']['totalFiles'] }} files</span>
            </a>
            <a href="#" class="quick-access-item" data-type="images">
                <div class="quick-access-content">
                    <i class="bi bi-image"></i>
                    <span>Images</span>
                </div>
                <span class="type-size">{{ $quickAccess['images']['size'] }}</span>
            </a>
            <a href="#" class="quick-access-item" data-type="documents">
                <div class="quick-access-content">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Documents</span>
                </div>
                <span class="type-size">{{ $quickAccess['documents']['size'] }}</span>
            </a>
            <a href="#" class="quick-access-item" data-type="videos">
                <div class="quick-access-content">
                    <i class="bi bi-camera-video"></i>
                    <span>Videos</span>
                </div>
                <span class="type-size">{{ $quickAccess['videos']['size'] }}</span>
            </a>
            <a href="#" class="quick-access-item" data-type="music">
                <div class="quick-access-content">
                    <i class="bi bi-music-note-beamed"></i>
                    <span>Music</span>
                </div>
                <span class="type-size">{{ $quickAccess['music']['size'] }}</span>
            </a>
        </div>
    </div>

    <!-- Storage Info -->
    @include('master-file-manager::partials._storage-info')
</section>