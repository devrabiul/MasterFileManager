<?php


if (!function_exists('renderMasterFileManagerView')) {
    function renderMasterFileManagerView(array $data = [])
    {
        return view('file-manager.partials.container', ['data' => $data]);
        // return view('file-manager.index', ['data' => $data]);
    }
}