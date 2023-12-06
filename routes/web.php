<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
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

Route::GET('/', [userController::class, 'homePage'])->name('home');
ROUTE::GET('verification/{token}', [authController::class, 'verifyEmail'])->name('verification');
Route::POST('forgot-password', [authController::class, 'ForgotPasswordRequest'])->name('forgotPasswordRequest');
Route::POST('reset-password', [authController::class, 'ResetPasswordRequest'])->name('resetPasswordRequest');
Route::POST('registerRequest', [authController::class, 'Register'])->name('registerRequest');
Route::POST('loginRequest', [authController::class, 'Login'])->name('loginRequest');
Route::GET('logoutRequest', [authController::class, 'Logout'])->name('logoutRequest');
Route::view('admin', './page/admin')->name('admin');
ROUTE::GET('menu', [userController::class, 'menuPage'])->name('menuPage');
ROUTE::VIEW('cart', 'page.cart')->name('cart');

ROUTE::POST('addToCart', [userController::class, 'addToCart'])->name('addToCart');

Route::middleware(['loggedIn'])->group(function () {
    Route::VIEW('register', './page/register')->name('registerPage');
    Route::VIEW('login', './page/login')->name('loginPage');
    Route::VIEW('forgot-password', './page/forgot-password')->name('forgotPassword');
    Route::GET('reset-password/{token}', [authController::class, 'ResetPasswordPage'])->name('resetPasswordPage');
});

Route::middleware(['admin'])->group(function () {
    Route::GET('admin', [adminController::class, 'adminPage'])->name('admin');
    Route::GET('activity', [adminController::class, 'activityPage'])->name('activity');
    Route::GET('product', [adminController::class, 'productPage'])->name('product');
    Route::POST('addProduct', [adminController::class, 'addProduct'])->name('addProduct');
    Route::POST('editProduct', [adminController::class, 'editProduct'])->name('editProduct');
    Route::POST('deleteProduct', [adminController::class, 'deleteProduct'])->name('deleteProduct');
});