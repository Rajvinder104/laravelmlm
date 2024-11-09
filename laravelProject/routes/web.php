<?php

use App\Http\Controllers\Site\Main;
use Illuminate\Support\Facades\Route;

// ****************** SITE ROUTES ******************
Route::controller(Main::class)->group(function () {
    Route::get('/', 'index')->name('');
});
// ****************** End Site  Controller ******************


// Include admin routes
require_once __DIR__ . '/admin.php';

// Include user routes
require_once __DIR__ . '/user.php';
