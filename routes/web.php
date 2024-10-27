<?php

use Illuminate\Support\Facades\Route;

Route::get('master-file-manager', function () {
    return view('master-file-manager::file-manager.index', ['data' => []]);
});