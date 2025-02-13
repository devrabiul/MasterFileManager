<?php

use Illuminate\Support\Facades\Route;
use Devrabiul\MasterFileManager\Controllers\FolderController;

Route::get('master-file-manager', function () {
    return view('master-file-manager::file-manager.index', ['data' => []]);
});

Route::post('master-file-manager/folder-content', function () {
    return response()->json([
        'html' => renderMasterFileManagerView()->render(),
    ]);
})->name('master-file-manager.folder-content');

Route::prefix('folders')->group(function () {
    Route::post('/rename', [FolderController::class, 'rename']);
    Route::post('/copy', [FolderController::class, 'copy']);
    Route::post('/move', [FolderController::class, 'move']);
    Route::get('/info', [FolderController::class, 'info']);
    Route::delete('/delete', [FolderController::class, 'delete']);
});