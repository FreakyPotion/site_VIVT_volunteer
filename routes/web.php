<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthChecker;


Route::middleware([AuthChecker::class])->group(function ()
{ 
    Route::get('/', [EventsController::class, 'load_events']);
    Route::get('/events/{id}', [EventsController::class, 'events_details'])->name('events.details');
    Route::get('/authorization', [function () {
        return view('authorization');
    }])->name('authorization');
    Route::get('/lk', [UsersController::class, 'load_user_data'])->name('profile');
});

Route::get('/authorization', [function () {
    return view('authorization');
}])->name('authorization');

Route::get('/registration', [function () {
    return view('registration');
}])->name('registration');

Route::post('/authorization', [AuthController::class, 'login']);
Route::post('/lk', [AuthController::class, 'logout'])->name('logout');
Route::post('/lk/upload-avatar', [UsersController::class, 'upload_avatar'])->name('upload.avatar');

