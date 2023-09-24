<?php

use Tahir\CMS\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use Tahir\CMS\Controllers\PublicController;

Route::controller(PublicController::class)->group(function () {
  Route::get('', 'index');
});



Route::controller(MediaController::class)->group(function () {
  Route::get('media', 'index');
});

