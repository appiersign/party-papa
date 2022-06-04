<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;


Route::get('/guests/check-in', [GuestController::class, 'showCheckInForm']);
Route::put('/guests/check-in', [GuestController::class, 'checkIn']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', Dashboard::class);
    Route::resource('guests', GuestController::class);
    Route::post('/guests/{guest}/invite', [GuestController::class, 'invite']);
});

Route::resource('invitations', InvitationController::class)->only('update', 'show');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
