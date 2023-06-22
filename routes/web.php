<?php

use App\Http\Controllers\AdminControllers\AdminDashboardController;
use App\Http\Controllers\AdminControllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\UserDashboardController;
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

Route::name('public.')->group(function () {
    Route::get('/', [PublicPagesController::class, 'homePage'])->name('home');
    Route::get('/about', [PublicPagesController::class, 'aboutPage'])->name('about');
    Route::get('/contact', [PublicPagesController::class, 'contactPage'])->name('contact');
    Route::name('account.')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->middleware('guest')->name('login');
        Route::post('login', [AuthController::class, 'auth'])->middleware('guest');
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
        Route::get('register', [AuthController::class, 'register'])->middleware('guest')->name('register');
        Route::post('register', [AuthController::class, 'store'])->middleware('guest');
        Route::name('user.dashboard.')->group(function () {
            Route::middleware('auth')->group(function () {
                Route::prefix('/dashboard')->group(function () {
                    Route::get('/', [UserDashboardController::class, 'home'])->name('home');
                    Route::get('/profile-info', [UserDashboardController::class, 'profileInfo'])->name('profile_info');
                    Route::put('/profile-info/{user}', [UserController::class, 'update'])->name('profile_info_update');
                });
            });
        });
    });
});

Route::name('admin.dashboard.')->group(function () {
    Route::middleware(['auth', 'role:ADMIN_ROLE'])->group(function () {
        Route::prefix('/admin-dashboard')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'home'])->name('home');
            Route::resource('/users', UserController::class)->except('show');
            Route::get('/profile-info', [AdminDashboardController::class, 'profileInfo'])->name('profile_info');
            Route::put('/profile-info', [AdminDashboardController::class, 'update'])->name('profile_info_update');
        });
    });
});
