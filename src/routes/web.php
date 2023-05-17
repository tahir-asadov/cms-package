<?php

use Illuminate\Support\Facades\Route;
use Tahir\CMS\Controllers\CMSController;

Route::controller(CMSController::class)->group(function () {
  Route::get('', 'index');
});

