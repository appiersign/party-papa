<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class);
Route::get('/guests/check-in', [GuestController::class, 'showCheckInForm']);
Route::put('/guests/check-in', [GuestController::class, 'checkIn']);
Route::resource('guests', GuestController::class);

Route::post('/guests/{guest}/invite', [GuestController::class, 'invite']);
Route::resource('invitations', InvitationController::class)->only('update', 'show');
