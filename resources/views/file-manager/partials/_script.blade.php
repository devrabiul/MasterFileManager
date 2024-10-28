<script>
    function openFolderByAjax(pathName, folderName) {
        $.ajax({
            url: "{{ route('master-file-manager.folder-content') }}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                path: pathName,
                folder: folderName,
            },
            success: function (data) {
                // $('.file_manager_folder_content').empty().html(data.htmlView);

                $('.file_manager_folder_content').fadeOut('fast', function () {
                    $(this).empty().html(data.htmlView).fadeIn('fast');
                });
            },
        });
    }
</script>