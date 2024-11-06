<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;

Route::get('/', [EventsController::class, 'load_events']);

Route::get('/authorization', function () {
    return view('authorization');
});

Route::get('/events/{id}', [EventsController::class, 'events_details'])->name('events.details');