<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class);
Route::resource('guests', GuestController::class);

Route::get('/check-in', function () {
    return view('check-in');
});

Route::group(['prefix' => 'invites'], function () {
    Route::get('/', fn() => inertia('Invite/List'));
    Route::get('/create', fn() => inertia('Invite/Send'));
});
Route::post('/guests/{guest}/invite', [GuestController::class, 'invite']);
Route::resource('invitations', InvitationController::class)->only('update', 'show');
