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
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserUpgradeController;

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


// Menu Kelola User
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
    Route::post('/users-management/rfid/{user}', [AnggotaRFIDController::class, 'rfid'])->name('usersrfid.rfid');
});
Route::prefix('kelola-user-upgrade')->middleware('auth')->group(function () {
    Route::get('/users-management', [UserUpgradeController::class, 'index'])->name('usersUpgrade-management');
    Route::get('/users-management/{user}/edit', [UserUpgradeController::class, 'edit'])->name('usersUpgrade.edit');
    Route::post('/users-management/delete/{user}', [UserUpgradeController::class, 'hapus'])->name('usersUpgrade.destroy');
});

// Menu Kelola Buku
Route::prefix('kelola-buku')->middleware('auth')->group(function () {
    Route::get('/', [BukuController::class, 'index'])->name('buku');
});
Route::prefix('kelola-penerbit')->middleware('auth')->group(function () {
    Route::get('/', [BukuController::class, 'index_penerbit'])->name('penerbit');
});
Route::prefix('kelola-pengarang')->middleware('auth')->group(function () {
    Route::get('/', [BukuController::class, 'index_pengarang'])->name('pengarang');
    Route::post('/tambah', [BukuController::class, 'store_pengarang'])->name('pengarang.store');
    Route::get('/edit/{id}', [BukuController::class, 'edit_pengarang'])->name('pengarang.edit');
    Route::post('/update/{id}', [BukuController::class, 'update_pengarang'])->name('pengarang.update');
    Route::post('/delete/{id}', [BukuController::class, 'hapus_pengarang'])->name('pengarang.destroy');
});
Route::prefix('kelola-rak')->middleware('auth')->group(function () {
    Route::get('/', [BukuController::class, 'index_rak'])->name('rak');
    Route::post('/tambah', [BukuController::class, 'store_rak'])->name('rak.store');
    Route::get('/edit/{id}', [BukuController::class, 'edit_rak'])->name('rak.edit');
    Route::post('/update/{id}', [BukuController::class, 'update_rak'])->name('rak.update');
    Route::post('/delete/{id}', [BukuController::class, 'hapus_rak'])->name('rak.destroy');
});

// Menu Kelola Peminjaman
Route::prefix('kelola-pinjam-ajuan')->middleware('auth')->group(function () {
    Route::get('/', [PeminjamanController::class, 'index'])->name('ajuan');
});
Route::prefix('kelola-pengarang-sukses')->middleware('auth')->group(function () {
});
