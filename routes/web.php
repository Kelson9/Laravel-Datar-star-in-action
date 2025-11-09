<?php

use Illuminate\Support\Facades\Route;
use Dancycodes\Hyper\Routing\Discovery\Discover;
use App\Http\Controllers\Discover\AuthController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware('web')->group(function () {
    Discover::controllers()->in(app_path('Http/Controllers/Discover'));
    
    Route::post('auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});