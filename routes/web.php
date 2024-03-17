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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RFIDController;
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

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect('/sign-in');
    });

    Route::get('/sign-up', [RegisterController::class, 'create'])
        ->name('sign-up');

    Route::post('/sign-up', [RegisterController::class, 'store']);

    Route::get('/sign-in', [LoginController::class, 'create'])
        ->name('sign-in');

    Route::post('/sign-in', [LoginController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'store']);

    Route::get('/admin', [LoginController::class, 'create_admin'])
        ->name('admin');

    Route::post('/admin', [LoginController::class, 'store_admin']);
});



Route::group(['middleware' => ['auth', 'posisi:2']], function () {
    Route::post('/logoutt', [LoginController::class, 'destroy'])
        ->name('logoutt');
    Route::prefix('dashboard-anggota')->group(function () {
        Route::get('/', [DashboardController::class, 'index_anggota'])->name('dashboard-anggota');
    });
});

// Authenticated Routes admin
Route::group(['middleware' => ['auth', 'posisi:1']], function () {
    Route::post('/logout', [LoginController::class, 'destroy_admin'])
        ->name('logout');

    Route::get('/kelola-user/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('/kelola-user/user-profile/update', [ProfileController::class, 'update'])->name('users.update_profile');
    Route::get('/kelola-user/users-management', [UserController::class, 'index'])->name('users-management');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/get-user', [DashboardController::class, 'getuser'])->name('users.dashboard');
    });

    // Menu Kelola User
    Route::prefix('kelola-user')->group(function () {
        Route::get('/users-management', [UserController::class, 'index'])->name('users-management');
        Route::get('/users-management/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users-management', [UserController::class, 'store'])->name('users.store');
        Route::get('/users-management/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users-management/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users-management/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::post('/users-management/delete/{user}', [UserController::class, 'hapus'])->name('users.destroy');
    });

    Route::prefix('kelola-user-rfid')->group(function () {
        Route::get('/users-management', [AnggotaRFIDController::class, 'index'])->name('usersrfid-management');
        Route::get('/users-management/create', [AnggotaRFIDController::class, 'create'])->name('usersrfid.create');
        Route::post('/users-management', [AnggotaRFIDController::class, 'store'])->name('usersrfid.store');
        Route::get('/users-management/{user}', [AnggotaRFIDController::class, 'show'])->name('usersrfid.show');
        Route::get('/users-management/{user}/edit', [AnggotaRFIDController::class, 'edit'])->name('usersrfid.edit');
        Route::post('/users-management/update/{user}', [AnggotaRFIDController::class, 'update'])->name('usersrfid.update');
        Route::post('/users-management/delete/{user}', [AnggotaRFIDController::class, 'hapus'])->name('usersrfid.destroy');
        Route::post('/users-management/rfid/{user}', [AnggotaRFIDController::class, 'rfid'])->name('usersrfid.rfid');
    });

    Route::prefix('kelola-user-upgrade')->group(function () {
        Route::get('/users-management', [UserUpgradeController::class, 'index'])->name('usersUpgrade-management');
        Route::get('/users-management/{user}/edit', [UserUpgradeController::class, 'edit'])->name('usersUpgrade.edit');
        Route::post('/users-management/delete/{user}', [UserUpgradeController::class, 'hapus'])->name('usersUpgrade.destroy');
    });

    Route::prefix('kelola-rfid')->group(function () {
        Route::get('/', [RFIDController::class, 'index'])->name('rfid');
        Route::post('/tambah', [RFIDController::class, 'store'])->name('rfid.store');
        Route::get('/edit/{id}', [RFIDController::class, 'edit'])->name('rfid.edit');
        Route::post('/update/{id}', [RFIDController::class, 'update'])->name('rfid.update');
        Route::post('/delete/{id}', [RFIDController::class, 'hapus'])->name('rfid.destroy');
    });

    // Menu Kelola Buku
    Route::prefix('kelola-buku')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('buku');
        Route::post('/tambah', [BukuController::class, 'store_buku'])->name('buku.store');
        Route::get('/edit/{id}', [BukuController::class, 'edit_buku'])->name('buku.edit');
        Route::post('/update/{id}', [BukuController::class, 'update_buku'])->name('buku.update');
        Route::post('/delete/{id}', [BukuController::class, 'hapus_buku'])->name('buku.destroy');
    });

    Route::prefix('kelola-penerbit')->group(function () {
        Route::get('/', [BukuController::class, 'index_penerbit'])->name('penerbit');
        Route::post('/tambah', [BukuController::class, 'store_penerbit'])->name('penerbit.store');
        Route::get('/edit/{id}', [BukuController::class, 'edit_penerbit'])->name('penerbit.edit');
        Route::post('/update/{id}', [BukuController::class, 'update_penerbit'])->name('penerbit.update');
        Route::post('/delete/{id}', [BukuController::class, 'hapus_penerbit'])->name('penerbit.destroy');
    });

    Route::prefix('kelola-pengarang')->group(function () {
        Route::get('/', [BukuController::class, 'index_pengarang'])->name('pengarang');
        Route::post('/tambah', [BukuController::class, 'store_pengarang'])->name('pengarang.store');
        Route::get('/edit/{id}', [BukuController::class, 'edit_pengarang'])->name('pengarang.edit');
        Route::post('/update/{id}', [BukuController::class, 'update_pengarang'])->name('pengarang.update');
        Route::post('/delete/{id}', [BukuController::class, 'hapus_pengarang'])->name('pengarang.destroy');
    });

    Route::prefix('kelola-rak')->group(function () {
        Route::get('/', [BukuController::class, 'index_rak'])->name('rak');
        Route::post('/tambah', [BukuController::class, 'store_rak'])->name('rak.store');
        Route::get('/edit/{id}', [BukuController::class, 'edit_rak'])->name('rak.edit');
        Route::post('/update/{id}', [BukuController::class, 'update_rak'])->name('rak.update');
        Route::post('/delete/{id}', [BukuController::class, 'hapus_rak'])->name('rak.destroy');
    });

    // Menu Kelola Peminjaman
    Route::prefix('kelola-pinjam-ajuan')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('ajuan');
    });
});
