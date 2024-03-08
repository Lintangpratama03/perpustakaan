<?php

use App\Http\Controllers\AnggotaHapusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaRFIDController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/kelola-user/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/kelola-user/user-profile/update', [ProfileController::class, 'update'])->name('users.update_profile')->middleware('auth');
Route::get('/kelola-user/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');

Route::prefix('kelola-user')->middleware('auth')->group(function () {
    Route::get('/users-management', [UserController::class, 'index'])->name('users-management');
    Route::get('/users-management/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users-management', [UserController::class, 'store'])->name('users.store');
    Route::get('/users-management/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users-management/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users-management/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users-management/delete/{user}', [UserController::class, 'hapus'])->name('users.destroy');
});
Route::prefix('kelola-user-rfid')->middleware('auth')->group(function () {
    Route::get('/users-management', [AnggotaRFIDController::class, 'index'])->name('usersrfid-management');
    Route::get('/users-management/create', [AnggotaRFIDController::class, 'create'])->name('usersrfid.create');
    Route::post('/users-management', [AnggotaRFIDController::class, 'store'])->name('usersrfid.store');
    Route::get('/users-management/{user}', [AnggotaRFIDController::class, 'show'])->name('usersrfid.show');
    Route::get('/users-management/{user}/edit', [AnggotaRFIDController::class, 'edit'])->name('usersrfid.edit');
    Route::post('/users-management/update/{user}', [AnggotaRFIDController::class, 'update'])->name('usersrfid.update');
    Route::post('/users-management/delete/{user}', [AnggotaRFIDController::class, 'hapus'])->name('usersrfid.destroy');
});
Route::prefix('kelola-user-hapus')->middleware('auth')->group(function () {
    Route::get('/users-management', [AnggotaHapusController::class, 'index'])->name('usersHapus-management');
    Route::get('/users-management/create', [AnggotaHapusController::class, 'create'])->name('usersHapus.create');
    Route::post('/users-management', [AnggotaHapusController::class, 'store'])->name('usersHapus.store');
    Route::get('/users-management/{user}', [AnggotaHapusController::class, 'show'])->name('usersHapus.show');
    Route::get('/users-management/{user}/edit', [AnggotaHapusController::class, 'edit'])->name('usersHapus.edit');
    Route::post('/users-management/update/{user}', [AnggotaHapusController::class, 'update'])->name('usersHapus.update');
    Route::post('/users-management/delete/{user}', [AnggotaHapusController::class, 'hapus'])->name('usersHapus.destroy');
});
