<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SettingController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/index', [IndexController::class, 'index'])->name('admin');

Route::group(['as' => 'dashboard.'], function () {
    Route::put('settings/{setting}/update', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::delete('categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::resource('categories', CategoryController::class);
});
