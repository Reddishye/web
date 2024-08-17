<?php

use App\Http\Controllers\LinksManager;
use App\Http\Controllers\LinksViewer;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LicenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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

    //Route::get('/calendar/week/{date}', [CalendarController::class, 'showWeek'])->name('calendar.week');
    //Route::post('/calendar/event/create', [CalendarController::class, 'createEvent'])->name('calendar.event.create');
    //Route::post('/calendar/event/store', [CalendarController::class, 'storeEvent'])->name('calendar.event.store');
    //Route::post('/calendar/event/edit/{id}', [CalendarController::class, 'editEvent'])->name('calendar.event.edit');
    //Route::post('/calendar/event/update/{id}', [CalendarController::class, 'updateEvent'])->name('calendar.event.update');
    //Route::post('/calendar/event/delete/{id}', [CalendarController::class, 'deleteEvent'])->name('calendar.event.delete');
    Route::get('/calendar/{month?}/{year?}', [CalendarController::class, 'index'])->name('calendar.index');

    //Route::get('events/create', function () {
    //    return view('events.create');
    //})->name('events.create');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
});

Route::get('/auth/discord', [App\Http\Controllers\DiscordController::class, 'redirectToProvider'])->name('auth.discord');
Route::get('/auth/discord/callback', [App\Http\Controllers\DiscordController::class, 'handleProviderCallback']);


Route::get('/api/checklicense/{licenseKey}', [App\Http\Controllers\Api\LicenseController::class, 'checkLicense']);
