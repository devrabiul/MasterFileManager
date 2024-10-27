<?php


if (!function_exists('renderMasterFileManagerView')) {
    function renderMasterFileManagerView(array $data = [])
    {
        return view('master-file-manager::file-manager.partials.container', ['data' => $data]);
        // return view('master-file-manager::file-manager.index', ['data' => $data]);
    }
}