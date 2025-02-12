<!-- First load jQuery -->
<script src="{{ masterFileManagerAsset('assets/js/jquery-3.7.1.min.js') }}"></script>

<!-- Then load FilePond and its plugins -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<!-- Finally load your custom scripts -->
<script src="{{ masterFileManagerAsset('assets/js/files.js') }}"></script>
