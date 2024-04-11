<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/checklicense/{licenseKey}', [App\Http\Controllers\Api\LicenseController::class, 'checkLicense']);
