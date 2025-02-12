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
                        <span class="type-size">--</span>
                    </a>
                    <a href="#" class="quick-access-item" data-type="favorites">
                        <div class="quick-access-content">
                            <i class="bi bi-star"></i>
                            <span>Favorites</span>
                        </div>
                        <span class="type-size">--</span>
                    </a>
                    <a href="#" class="quick-access-item" data-type="images">
                        <div class="quick-access-content">
                            <i class="bi bi-image"></i>
                            <span>Images</span>
                        </div>
                        <span class="type-size">15.3 GB</span>
                    </a>
                    <a href="#" class="quick-access-item" data-type="documents">
                        <div class="quick-access-content">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Documents</span>
                        </div>
                        <span class="type-size">5.2 GB</span>
                    </a>
                    <a href="#" class="quick-access-item" data-type="videos">
                        <div class="quick-access-content">
                            <i class="bi bi-camera-video"></i>
                            <span>Videos</span>
                        </div>
                        <span class="type-size">32.1 GB</span>
                    </a>
                    <a href="#" class="quick-access-item" data-type="music">
                        <div class="quick-access-content">
                            <i class="bi bi-music-note-beamed"></i>
                            <span>Music</span>
                        </div>
                        <span class="type-size">12.8 GB</span>
                    </a>
                
                </div>
            </div>

            <!-- Storage Info -->
            <div class="storage-info-section">
                <!-- Storage Summary -->
                <div class="storage-overview">
                    <div class="storage-header">
                        <div class="storage-title">
                            <i class="bi bi-hdd-fill"></i>
                            <span>Storage</span>
                        </div>
                        <span class="storage-percentage">75.5%</span>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="storage-progress">
                    <div class="progress-bar">
                        <div class="progress" style="width: 75.5%">
                            <div class="progress-glow"></div>
                        </div>
                    </div>
                </div>

                <!-- Storage Details -->
                <div class="storage-details">
                    <div class="storage-used">
                        <span class="storage-label">Used</span>
                        <span class="storage-value">75.5 GB</span>
                    </div>
                    <div class="storage-divider"></div>
                    <div class="storage-total">
                        <span class="storage-label">Total</span>
                        <span class="storage-value">100 GB</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sidebar Container | End -->

        <!-- Files Container | Start -->
        <section class="file-manager-files-container temp-border">

            <div>
                <h5 class="folders-section-title">
                    <span><i class="bi bi-folder-fill"></i></span>
                    <span>Folders</span>
                </h5>
                <p class="folders-section-subtitle">Manage your folders easily</p>
            </div>
            <div class="file-manager-folders-section">
                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="" class="svg">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>
                
                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>
                
                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>
                
                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>


                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-folder-item">
                    <div class="folder-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="folder-title">
                        Folder Name
                    </div>

                    <div class="folder-info">
                        25 MB
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div>
                <h5 class="folders-section-title">
                    <span><i class="bi bi-grid-fill"></i></span>
                    <span>Files</span>
                </h5>
                <p class="folders-section-subtitle">Browse and organize your files effortlessly</p>
            </div>

            <div class="file-manager-files-section">
                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/folder.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/execl.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/image.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/ppt.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>


                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/txt.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>


                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/video.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

                <div class="file-manager-files-item">
                    <div class="files-icon">
                        <img src="{{ masterFileManagerAsset('assets/images/zip.svg') }}" alt="" srcset="">
                    </div>
                    <div class="files-information">
                        <div class="files-title">
                            Files Name Files Name Files Name Files Name
                        </div>

                        <div class="files-info">
                            64 Files / 578.59 KB
                        </div>
                    </div>

                    <div class="files-option-element">
                        <button class="menu-dot"><i class="bi bi-three-dots"></i></button>
                    </div>
                </div>

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