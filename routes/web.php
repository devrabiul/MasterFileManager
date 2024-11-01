<?php

use Illuminate\Support\Facades\Route;

Route::get('master-file-manager', function () {
    return view('master-file-manager::file-manager.index', ['data' => []]);
});

Route::post('master-file-manager/folder-content', function () {
    return response()->json([
        'html' => renderMasterFileManagerView()->render(),
    ]);
})->name('master-file-manager.folder-content');