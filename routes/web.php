<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\LinksManager;
use App\Http\Controllers\LinksViewer;

Route::get('/', [UserViewController::class, 'index'])->name('home');
Route::get('/links/{path?}', [LinksViewer::class, 'redirect'])->where('path', '.*')->name('links.redirect');
Route::redirect('/dashboard', '/admin/dashboard');

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('projects', ProjectController::class);

    Route::resource('links', LinksManager::class);

    Route::resource('users', UserController::class);
});
