<?php

use Illuminate\Support\Facades\Route;
use Tahir\CMS\Controllers\PublicController;

Route::controller(PublicController::class)->group(function () {
  Route::get('', 'index');
});

