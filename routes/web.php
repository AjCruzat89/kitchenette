<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', './page/home')->name('home');
Route::POST('forgot-password', [authController::class, 'ForgotPasswordRequest'])->name('forgotPasswordRequest');
Route::POST('reset-password', [authController::class, 'ResetPasswordRequest'])->name('resetPasswordRequest');
Route::POST('registerRequest', [authController::class, 'Register'])->name('registerRequest');
Route::POST('loginRequest', [authController::class, 'Login'])->name('loginRequest');
Route::GET('logoutRequest', [authController::class, 'Logout'])->name('logoutRequest');
Route::view('admin', './page/admin')->name('admin');

Route::middleware(['loggedIn'])->group(function () {
    Route::view('register', './page/register')->name('registerPage');
    Route::view('login', './page/login')->name('loginPage');
    Route::view('forgot-password', './page/forgot-password')->name('forgotPassword');
    Route::GET('reset-password/{token}', [authController::class, 'ResetPasswordPage'])->name('resetPasswordPage');
});

Route::middleware(['admin'])->group(function () {
    Route::view('admin', './page/admin')->name('admin');
    Route::GET('activity', [adminController::class, 'activityLog'])->name('activity');
});