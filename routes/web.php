<?php

use Illuminate\Support\Facades\Route;

Route::get('master-file-manager', function () {
    return view('file-manager.index', ['data' => []]);
});