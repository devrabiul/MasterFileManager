function toggleDropdown(event, button) {
    event.stopPropagation();
    
    // Close all other open dropdowns
    const allDropdowns = document.querySelectorAll('.files-dropdown-menu');
    allDropdowns.forEach(dropdown => {
        if (dropdown !== button.nextElementSibling) {
            dropdown.classList.remove('show');
        }
    });

    // Toggle current dropdown
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.files-dropdown-menu');
    dropdowns.forEach(dropdown => {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
});

// Prevent dropdown from closing when clicking inside it
document.querySelectorAll('.files-dropdown-menu').forEach(dropdown => {
    dropdown.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});

function openFolderByAjax(targetFolder, folderName) {
    const url = new URL(window.location.href);

    $.ajax({
        url: $('.file-manager-files-container').data('route'),
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            targetFolder: targetFolder,
        },
        beforeSend: function () {
            $(".master-file-manager-loader-container").removeClass('loader-container-hide');
        },
        success: function (response) {
            $('.master-file-manager-content').fadeOut('fast', function () {
                $(this).empty().html(response.html).fadeIn('fast');
            });

            targetFolder ? url.searchParams.set('targetFolder', targetFolder) : url.searchParams.delete('targetFolder');
            window.history.pushState({}, '', url);
        },
        complete: function () {
            setTimeout(() => {
                $(".master-file-manager-loader-container").addClass('loader-container-hide');
            }, 200);
        },
    });
}

function renameFolder(path) {
    event.preventDefault();
    
    const newName = prompt("Enter new folder name:");
    if (!newName) return;

    $.ajax({
        url: '/folders/rename',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            path: path,
            newName: newName
        },
        beforeSend: function() {
            $(".master-file-manager-loader-container").removeClass('loader-container-hide');
        },
        success: function(response) {
            if (response.success) {
                // Refresh the file manager content
                $('.master-file-manager-content').fadeOut('fast', function() {
                    $(this).empty().html(response.html).fadeIn('fast');
                });
                toastr.success('Folder renamed successfully');
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON.message || 'Error renaming folder');
        },
        complete: function() {
            $(".master-file-manager-loader-container").addClass('loader-container-hide');
        }
    });
}

function copyFolder(path) {
    event.preventDefault();
    
    $.ajax({
        url: '/folders/copy',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            path: path
        },
        beforeSend: function() {
            $(".master-file-manager-loader-container").removeClass('loader-container-hide');
        },
        success: function(response) {
            if (response.success) {
                $('.master-file-manager-content').fadeOut('fast', function() {
                    $(this).empty().html(response.html).fadeIn('fast');
                });
                toastr.success('Folder copied successfully');
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON.message || 'Error copying folder');
        },
        complete: function() {
            $(".master-file-manager-loader-container").addClass('loader-container-hide');
        }
    });
}

function moveFolder(path) {
    event.preventDefault();
    
    // You might want to show a modal with available destinations here
    const destination = prompt("Enter destination path:");
    if (!destination) return;

    $.ajax({
        url: '/folders/move',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            path: path,
            destination: destination
        },
        beforeSend: function() {
            $(".master-file-manager-loader-container").removeClass('loader-container-hide');
        },
        success: function(response) {
            if (response.success) {
                $('.master-file-manager-content').fadeOut('fast', function() {
                    $(this).empty().html(response.html).fadeIn('fast');
                });
                toastr.success('Folder moved successfully');
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON.message || 'Error moving folder');
        },
        complete: function() {
            $(".master-file-manager-loader-container").addClass('loader-container-hide');
        }
    });
}

function getFolderInfo(path) {
    event.preventDefault();
    
    $.ajax({
        url: '/folders/info',
        type: 'GET',
        data: {
            path: path
        },
        beforeSend: function() {
            $(".master-file-manager-loader-container").removeClass('loader-container-hide');
        },
        success: function(response) {
            if (response.success) {
                // Show folder info in a modal
                $('#folderInfoModal').find('.modal-body').html(response.html);
                $('#folderInfoModal').modal('show');
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON.message || 'Error getting folder info');
        },
        complete: function() {
            $(".master-file-manager-loader-container").addClass('loader-container-hide');
        }
    });
}

function deleteFolder(path) {
    event.preventDefault();
    
    if (!confirm('Are you sure you want to delete this folder?')) return;

    $.ajax({
        url: '/folders/delete',
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            path: path
        },
        beforeSend: function() {
            $(".master-file-manager-loader-container").removeClass('loader-container-hide');
        },
        success: function(response) {
            if (response.success) {
                $('.master-file-manager-content').fadeOut('fast', function() {
                    $(this).empty().html(response.html).fadeIn('fast');
                });
                toastr.success('Folder deleted successfully');
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON.message || 'Error deleting folder');
        },
        complete: function() {
            $(".master-file-manager-loader-container").addClass('loader-container-hide');
        }
    });
}
document.getElementById('fileSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const fileItems = document.querySelectorAll('.file-manager-files-item');
    const filesContainer = document.querySelector('.file-manager-files-section');
    const searchResultsEmptyState = document.querySelector('.search-results-empty-state-container');
    let visibleCount = 0;
    
    fileItems.forEach(item => {
        const filename = item.getAttribute('data-filename');
        if (filename.includes(searchTerm)) {
            item.style.display = 'flex';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    if (searchTerm) {
        if (visibleCount === 0) {
            // Show empty state in search results container
            const emptyState = `
                <div class="file-manager-empty-state">
                    <div class="empty-state-content">
                        <i class="bi bi-search"></i>
                        <h3>No Results Found</h3>
                        <p>No files match your search for "${searchTerm}"</p>
                    </div>
                </div>
            `;
            searchResultsEmptyState.innerHTML = emptyState;
            searchResultsEmptyState.style.display = 'block';
        } else {
            searchResultsEmptyState.style.display = 'none';
            searchResultsEmptyState.innerHTML = '';
        }
    } else {
        searchResultsEmptyState.style.display = 'none';
        searchResultsEmptyState.innerHTML = '';
    }
});

function previewFile(fileType, filePath, fileName) {
    if (fileType === 'image') {
        const modal = document.getElementById('imageViewerModal');
        const modalImg = document.getElementById('modalImage');
        modal.style.display = "block";
        modalImg.src = "{{ masterFileManagerStorage('storage/app/public/') }}" + filePath;
    } else {
        // Show file info modal for non-image files
        const modal = document.getElementById('fileInfoModal');
        const titleElement = document.getElementById('fileInfoTitle');
        const detailsElement = document.getElementById('fileInfoDetails');
        
        titleElement.textContent = fileName;
        detailsElement.innerHTML = `
            <p><strong>Type:</strong> ${fileType}</p>
            <p><strong>Path:</strong> ${filePath}</p>
        `;
        modal.style.display = "block";
    }
}

// Close modal when clicking on X
document.querySelectorAll('.master-file-manager-modal-close').forEach(closeBtn => {
    closeBtn.onclick = function() {
        this.closest('.master-file-manager-modal').style.display = "none";
    }
});

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('master-file-manager-modal')) {
        event.target.style.display = "none";
    }
}