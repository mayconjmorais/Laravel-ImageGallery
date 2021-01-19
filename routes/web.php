<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'App\Http\Controllers\GalleryController@index') ->name('images.index');
Route::post('/image-store', 'App\Http\Controllers\GalleryController@store')->name('imagestore');
Route::get('/deleteimage/{id}', 'App\Http\Controllers\HomeController@delete');
Route::get('/hiddenimage/{id}', 'App\Http\Controllers\HomeController@hidden');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
