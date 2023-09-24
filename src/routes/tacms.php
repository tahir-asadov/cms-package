<?php

use Tahir\CMS\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use Tahir\CMS\Http\Controllers\PublicController;

Route::controller(PublicController::class)->group(function () {
  Route::get('', 'index');
});

Route::controller(MediaController::class)->name('media.')->group(function () {
  Route::get('/medias', 'index')->name('index');
  Route::get('/media/create', 'create')->name('create');
  Route::post('/media/store', 'store')->name('store');
  Route::get('/media/{media}/edit', 'edit')->name('edit');
  Route::put('/media/{media}/update', 'update')->name('update');
  Route::delete('/media/{media}/destroy', 'destroy')->name('delete');
  Route::delete('/media/destroy', 'bulkDestroy')->name('bulkDelete');
  Route::get('/media/{media}/download', 'download')->name('download');
});

