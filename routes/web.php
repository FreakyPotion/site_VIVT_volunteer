<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Middleware\AuthChecker;
use App\Http\Middleware\AuthCheckerReverse;


Route::get('/', [EventsController::class, 'load_events'])->name('main.page');
Route::get('/archive', [EventsController::class, 'load_archive_events'])->name('archive.events');
Route::get('/events/{id}', [EventsController::class, 'events_details'])->name('events.details');

Route::middleware([AuthChecker::class])->group(function ()
{ 
    Route::get('/events/{id}/list', [EventsController::class, 'events_details_list'])->name('events.details.list');
    Route::get('/events/{id}/finish', [EventsController::class, 'eventFinishView'])->name('events.finish');
    Route::get('/events/{id}/report', [EventsController::class, 'eventReportView'])->name('events.report');
    Route::get('/organizer/events', [EventsController::class, 'load_organizer_page'])->name('org.page');
    Route::get('/volunteer/events', [EventsController::class, 'load_volunteer_page'])->name('vol.page');
    Route::get('/user/{id}', [UsersController::class, 'load_other_user_data'])->name('other.profile');
    Route::get('/lk', [UsersController::class, 'load_user_data'])->name('profile');
    Route::get('/newevent', [function () {
        return view('create_event');
    }])->name('create.event');
    Route::get('/volunteer/events/myrequests', [EventsController::class, 'load_requests'])->name('my.requests');
});

Route::middleware([AuthCheckerReverse::class])->group(function ()
{ 
    Route::get('/authorization', [function () {
        return view('authorization');
    }])->name('authorization');

    Route::get('/registration', [UsersController::class, 'registration_view']);

    Route::get('/panel', [PanelController::class, 'getView'])->name('admin.panel');
});



Route::post('/authorization', [AuthController::class, 'login']);
Route::post('/lk', [AuthController::class, 'logout'])->name('logout');
Route::post('/lk/upload-avatar', [UsersController::class, 'upload_avatar'])->name('upload.avatar');
Route::post('/event/request/{id}', [EventsController::class, 'pullRequest'])->name('request');
Route::post('/event/request/accept/{event}/{user}', [EventsController::class, 'acceptUser'])->name('request.accept');
Route::post('/event/request/reject/{event}/{user}', [EventsController::class, 'rejectUser'])->name('request.reject');
Route::post('/events/{id}/finish', [EventsController::class, 'eventFinish'])->name('report.create');
Route::post('/newevent', [EventsController::class, 'create_event'])->name('create.event.post');
Route::post('/registration', [UsersController::class, 'registration'])->name('registration');
Route::post('/panel/security', [PanelController::class, 'changeData'])->name('change.data');
Route::post('/panel/update-row/{id}', [UsersController::class, 'updateRow'])->name('update.row');


Route::get('/panel/updateChart', [PanelController::class, 'updateStats']);

