<?php

use App\Http\Controllers\anggota\BukuAnggotaController;
use App\Http\Controllers\anggota\PeminjamanAnggotaController;
use App\Http\Controllers\anggota\PengajuanRfid;
use App\Http\Controllers\anggota\PengembalianAnggotaController;
use App\Http\Controllers\anggota\ProfileAnggotaController;
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
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PengunjungController;
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
        return redirect('/anggota/dashboard-anggota');
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



Route::prefix('anggota')->group(function () {
    Route::prefix('dashboard-anggota')->group(function () {
        Route::get('/', [DashboardController::class, 'index_anggota'])->name('dashboard-anggota');
        Route::post('/kunjungan', [DashboardController::class, 'storeKunjungan'])->name('kunjungan.store');
        Route::get('/get-kunjungan-umum', [DashboardController::class, 'getKunjunganData'])->name('kunjungan.dashboard.umum');
    });
    Route::prefix('buku')->group(function () {
        Route::get('/', [BukuAnggotaController::class, 'index'])->name('buku-anggota');
        Route::get('/add-book/{id}', [BukuAnggotaController::class, 'addBooktoCart'])->name('addbook.to.cart');
    });
    Route::middleware(['auth', 'check.last.activity'])->group(function () {
        Route::middleware(['posisi:2,3'])->group(function () {
            Route::post('/logoutt', [LoginController::class, 'destroy'])->name('logoutt');
            Route::prefix('kelola-user')->group(function () {
                Route::get('/', [ProfileAnggotaController::class, 'index_anggota'])->name('users.profile.anggota');
                Route::put('/profile/update', [ProfileAnggotaController::class, 'update_anggota'])->name('users.update_profile.anggota');
            });
        });
        Route::middleware(['posisi:3'])->group(function () {
            Route::prefix('pengajuan')->group(function () {
                Route::get('/', [PengajuanRfid::class, 'index'])->name('pengajuan');
                Route::get('/{user}/edit', [PengajuanRfid::class, 'edit'])->name('pengajuan.edit');
                Route::post('/update/{user}', [PengajuanRfid::class, 'update'])->name('pengajuan.update');
            });
        });
        Route::middleware(['posisi:2'])->group(function () {
            Route::prefix('shopping-cart')->group(function () {
                Route::get('/', [BukuAnggotaController::class, 'bookCart'])->name('shopping.cart');
                Route::get('/edit_scan', [BukuAnggotaController::class, 'edit_scan'])->name('buku.edit_scan');
                Route::post('/checkout', [BukuAnggotaController::class, 'checkout'])->name('checkout');
                Route::patch('/update-shopping-cart', [BukuAnggotaController::class, 'updateCart'])->name('update.sopping.cart');
                Route::post('/delete-cart-product/{id}', [BukuAnggotaController::class, 'deleteProduct'])->name('delete.cart.product');
            });
            Route::prefix('peminjaman')->group(function () {
                Route::get('/', [PeminjamanAnggotaController::class, 'index_ajuan'])->name('ajuan-peminjaman-anggota');
                Route::get('/edit/{id}', [PeminjamanAnggotaController::class, 'edit'])->name('ajuan-peminjaman-anggota.edit');
                Route::post('/tolak/{id}', [PeminjamanAnggotaController::class, 'tolak'])->name('ajuan-peminjaman-anggota.tolak');
            });
            Route::prefix('peminjaman-sukses')->group(function () {
                Route::get('/', [PeminjamanAnggotaController::class, 'index_sukses'])->name('sukses-peminjaman-anggota');
                Route::get('/edit_sukses/{id}', [PeminjamanAnggotaController::class, 'edit_sukses'])->name('sukses-peminjaman-anggota.edit');
            });
            Route::prefix('pengembalian')->group(function () {
                Route::get('/', [PengembalianAnggotaController::class, 'index'])->name('pengembalian-buku');
                Route::get('/edit/{id}', [PengembalianAnggotaController::class, 'edit'])->name('pengembalian-buku.edit');
                Route::post('/panjang/{id}', [PengembalianAnggotaController::class, 'panjang'])->name('pengembalian-buku.panjang');
            });
            Route::prefix('pengembalian-sukses')->group(function () {
                Route::get('/', [PengembalianAnggotaController::class, 'index_sukses'])->name('sukses-pengembalian-buku');
                Route::get('/edit/{id}', [PengembalianAnggotaController::class, 'edit_sukses'])->name('pengembalian-buku.edit');
            });
        });
    });
});


// Authenticated Routes admin
Route::group(['middleware' => ['auth', 'posisi:1', 'check.last.activity']], function () {
    Route::post('/logout', [LoginController::class, 'destroy_admin'])
        ->name('logout');

    Route::get('/kelola-user/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('/kelola-user/user-profile/update', [ProfileController::class, 'update'])->name('users.update_profile');
    Route::get('/kelola-user/users-management', [UserController::class, 'index'])->name('users-management');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/get-user', [DashboardController::class, 'getuser'])->name('users.dashboard');
        Route::get('/get-kunjungan', [DashboardController::class, 'getKunjunganData'])->name('kunjungan.dashboard');
        Route::get('/get-pinjam', [DashboardController::class, 'getPinjamData'])->name('pinjam.dashboard');
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

        Route::get('/edit_scan/{id}', [UserUpgradeController::class, 'edit_scan'])->name('upgrade.scan.edit');
        Route::post('/scan/{id}/{id_card}', [UserUpgradeController::class, 'scan'])->name('upgrade.scan');
    });

    Route::prefix('kelola-rfid')->group(function () {
        Route::get('/', [RFIDController::class, 'index'])->name('rfid');
        Route::post('/tambah', [RFIDController::class, 'store'])->name('rfid.store');
        Route::get('/edit/{id}', [RFIDController::class, 'edit'])->name('rfid.edit');
        Route::post('/update/{id}', [RFIDController::class, 'update'])->name('rfid.update');
        Route::post('/delete/{id}', [RFIDController::class, 'hapus'])->name('rfid.destroy');
    });

    Route::prefix('kelola-pengunjung')->group(function () {
        Route::get('/', [PengunjungController::class, 'index'])->name('kunjungan');
        Route::post('/tambah', [PengunjungController::class, 'store'])->name('kunjungan.store.pengunjung');
        Route::get('/edit/{id}', [PengunjungController::class, 'edit'])->name('kunjungan.edit');
        Route::post('/update/{id}', [PengunjungController::class, 'update'])->name('kunjungan.update');
        Route::post('/delete/{id}', [PengunjungController::class, 'hapus'])->name('kunjungan.destroy');
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
        Route::get('/edit/{id}', [PeminjamanController::class, 'edit'])->name('ajuan.edit');
        Route::post('/update/{id}', [PeminjamanController::class, 'update'])->name('ajuan.update');
        Route::post('/tolak/{id}', [PeminjamanController::class, 'tolak'])->name('ajuan.tolak');
        // scanpinjam
        Route::get('/edit_scan/{id}', [PeminjamanController::class, 'edit_scan'])->name('ajuan.scan.edit');
        Route::post('/scan/{id}/{id_card}', [PeminjamanController::class, 'scan'])->name('ajuan.scan');
    });

    Route::prefix('kelola-pinjam-sukses')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index_sukses'])->name('ajuan.sukses');
        Route::get('/edit_sukses/{id}', [PeminjamanController::class, 'edit_sukses'])->name('ajuan.sukses.edit');
    });
    Route::prefix('kelola-pinjam-panjang')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index_panjang'])->name('ajuan.panjang');
        Route::get('/edit_sukses/{id}', [PeminjamanController::class, 'edit_panjang'])->name('ajuan.panjang.edit');
        Route::get('/edit_scan/{id}', [PeminjamanController::class, 'edit_scan_panjang'])->name('panjang.scan.edit');
        Route::post('/scan/{id}/{id_card}', [PeminjamanController::class, 'scan_panjang'])->name('panjang.scan');
    });

    Route::prefix('kelola-kembali')->group(function () {
        Route::get('/', [PengembalianController::class, 'index'])->name('kembali');
        Route::get('/edit/{id}', [PengembalianController::class, 'edit'])->name('kembali.edit');
        Route::post('/update/{id}', [PengembalianController::class, 'update'])->name('kembali.update');
        Route::post('/tolak/{id}', [PengembalianController::class, 'tolak'])->name('kembali.tolak');

        Route::get('/edit_scan/{id}', [PengembalianController::class, 'edit_scan'])->name('kembali.scan.edit');
        Route::post('/scan/{id}/{id_card}/{denda}', [PengembalianController::class, 'scan'])->name('kembali.scan');
    });

    Route::prefix('kelola-kembali-sukses')->group(function () {
        Route::get('/', [PengembalianController::class, 'index_sukses'])->name('kembali.sukses');
        Route::get('/edit_sukses/{id}', [PengembalianController::class, 'edit_sukses'])->name('kembali.sukses.edit');
    });
});
