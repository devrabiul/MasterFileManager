<script>
    function openFolderByAjax(targetFolder, folderName) {
        const url = new URL(window.location.href);

        $.ajax({
            url: "{{ route('master-file-manager.folder-content') }}",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                targetFolder: targetFolder,
            },
            beforeSend: function () {
                $(".master-file-manager-loader-container").removeClass('loader-container-hide');
            },
            success: function (response) {
                $('.master-file-manager-container').fadeOut('fast', function () {
                    $(this).empty().html(response.html).fadeIn('fast');
                });

                targetFolder ? url.searchParams.set('targetFolder', targetFolder) : url.searchParams.delete('targetFolder');
                window.history.pushState({}, '', url);
            },
            complete: function () {
                $(".master-file-manager-loader-container").addClass('loader-container-hide');
            },
        });
    }
</script>