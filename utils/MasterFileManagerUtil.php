<?php


if (!function_exists('renderMasterFileManagerView')) {
    function renderMasterFileManagerView(array $data = [])
    {
        return view('master-file-manager::file-manager.partials.container', ['data' => $data]);
    }
}

if (!function_exists('renderMasterFileManagerStyle')) {
    function renderMasterFileManagerStyle()
    {
        return view('master-file-manager::file-manager.partials._style');
    }
}

if (!function_exists('renderMasterFileManagerJavaScript')) {
    function renderMasterFileManagerJavaScript()
    {
        return view('master-file-manager::file-manager.partials._script');
    }
}