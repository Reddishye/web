<?php

use App\Http\Controllers\LinksManager;
use App\Http\Controllers\LinksViewer;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\LicenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserViewController::class, 'index'])->name('home');
Route::get('/links/{path?}', [LinksViewer::class, 'redirect'])->where('path', '.*')->name('links.redirect');

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'permission:admin',
])->group(function () {
    Route::resource('projects', ProjectController::class);

    Route::resource('links', LinksManager::class);

    Route::resource('users', UserController::class);
    Route::put('/users/{user}/discord/unlink', [UserController::class, 'unlinkDiscord'])->name('users.discord.unlink');

    Route::get('analytics', function () {
    })->name('analytics');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('licenses', LicenseController::class);
});

Route::get('/auth/discord', [App\Http\Controllers\DiscordController::class, 'redirectToProvider'])->name('auth.discord');
Route::get('/auth/discord/callback', [App\Http\Controllers\DiscordController::class, 'handleProviderCallback']);
