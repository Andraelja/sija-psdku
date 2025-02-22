<?php

use App\Http\Controllers\Admin\JurnalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\JadwalKuliahController;
use App\Http\Controllers\Dosen\FormAbsenDosenController;
use App\Http\Controllers\Dosen\FormDosenDosenController;
use App\Http\Controllers\Dosen\FormJadwalDosenController;
use App\Http\Controllers\Dosen\FormJurnalDosenController;
use App\Http\Controllers\Dosen\FormMahasiswaDosenController;
use App\Http\Controllers\Dosen\FormMatkulDosenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes with Prefix
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Mahasiswa
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::get('/create', [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
        Route::post('/', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
        Route::get('/{id}/edit', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
        Route::put('/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
        Route::delete('/{id}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');
    });

    // Dosen
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('admin.dosen.index');
        Route::get('/create', [DosenController::class, 'create'])->name('admin.dosen.create');
        Route::post('/', [DosenController::class, 'store'])->name('admin.dosen.store');
        Route::get('/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
        Route::put('/{id}', [DosenController::class, 'update'])->name('admin.dosen.update');
        Route::delete('/{id}', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    });

    // Mata Kuliah
    Route::prefix('matkul')->group(function () {
        Route::get('/', [MatkulController::class, 'index'])->name('admin.matkul.index');
        Route::get('/create', [MatkulController::class, 'create'])->name('admin.matkul.create');
        Route::post('/', [MatkulController::class, 'store'])->name('admin.matkul.store');
        Route::get('/{id}/edit', [MatkulController::class, 'edit'])->name('admin.matkul.edit');
        Route::put('/{id}', [MatkulController::class, 'update'])->name('admin.matkul.update');
        Route::delete('/{id}', [MatkulController::class, 'destroy'])->name('admin.matkul.destroy');
    });

    // Absensi
    Route::prefix('absensi')->group(function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('admin.absensi.index');
        Route::get('/create', [AbsensiController::class, 'create'])->name('admin.absensi.create');
        Route::post('/', [AbsensiController::class, 'store'])->name('admin.absensi.store');
        Route::get('/{id}/edit', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');
        Route::put('/{id}', [AbsensiController::class, 'update'])->name('admin.absensi.update');
        Route::delete('/{id}', [AbsensiController::class, 'destroy'])->name('admin.absensi.destroy');
    });

    // Jadwal Kuliah
    Route::prefix('jadwal')->group(function () {
        Route::get('/', [JadwalKuliahController::class, 'index'])->name('admin.jadwal.index');
        Route::get('/create', [JadwalKuliahController::class, 'create'])->name('admin.jadwal.create');
        Route::post('/', [JadwalKuliahController::class, 'store'])->name('admin.jadwal.store');
        Route::get('/{id}/edit', [JadwalKuliahController::class, 'edit'])->name('admin.jadwal.edit');
        Route::put('/{id}', [JadwalKuliahController::class, 'update'])->name('admin.jadwal.update');
        Route::delete('/{id}', [JadwalKuliahController::class, 'destroy'])->name('admin.jadwal.destroy');
    });

    Route::prefix('absensi')->group(function () {
        Route::get('/admin/absensi/tambah-dummy', [AbsensiController::class, 'tambahDummy'])->name('admin.absensi.tambah-dummy');
        Route::get('/', [AbsensiController::class, 'index'])->name('admin.absensi.index');
        Route::get('/create', [AbsensiController::class, 'create'])->name('admin.absensi.create');
        Route::post('/', [AbsensiController::class, 'store'])->name('admin.absensi.store');
        Route::get('/{id}/edit', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');
        Route::put('/{id}', [AbsensiController::class, 'update'])->name('admin.absensi.update');
        Route::delete('/{id}', [AbsensiController::class, 'destroy'])->name('admin.absensi.destroy');
    });

    Route::prefix('jurnal')->group(function () {
        Route::get('/', [JurnalController::class, 'index'])->name('admin.jurnal.index');
        Route::get('/create', [JurnalController::class, 'create'])->name('admin.jurnal.create');
        Route::post('/', [JurnalController::class, 'store'])->name('admin.jurnal.store');
        Route::get('/{id}/edit', [JurnalController::class, 'edit'])->name('admin.jurnal.edit');
        Route::put('/{id}', [JurnalController::class, 'update'])->name('admin.jurnal.update');
        Route::delete('/{id}', [JurnalController::class, 'destroy'])->name('admin.jurnal.destroy');
    });

});

Route::get('/admin/jadwal/get-matkul/{angkatan}', [JadwalKuliahController::class, 'getMatkulByAngkatan']);


//form dosen
Route::prefix('dosen')->middleware(['auth', 'role:dosen'])->group(function () {
    // Dashboard Dosen
    Route::get('/dashboard', [DashboardController::class, 'dashboardDosen'])->name('dosen.dashboard');

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [FormMahasiswaDosenController::class, 'index'])->name('dosen.mahasiswa.index');
    });

    Route::prefix('dosen')->group(function () {
        Route::get('/', [FormDosenDosenController::class, 'index'])->name('dosen.dosen.index');
    });

    Route::prefix('matkul')->group(function () {
        Route::get('/', [FormMatkulDosenController::class, 'index'])->name('dosen.matkul.index');
    });

    Route::prefix('absensi')->group(function () {
        Route::get('/', [FormAbsenDosenController::class, 'index'])->name('dosen.absensi.index');
        Route::get('/create', [FormAbsenDosenController::class, 'create'])->name('dosen.absensi.create');
        Route::get('/matkul/{angkatan}', [FormAbsenDosenController::class, 'getMatkulByAngkatan']);
        Route::post('/', [FormAbsenDosenController::class, 'store'])->name('dosen.absensi.store');
    });

    Route::prefix('jadwal')->group(function () {
        Route::get('/', [FormJadwalDosenController::class, 'index'])->name('dosen.jadwal.index');
    });

    Route::prefix('jurnal')->group(function () {
        Route::get('/', [FormJurnalDosenController::class, 'index'])->name('dosen.jurnal.index');
        Route::get('/create', [FormJurnalDosenController::class, 'create'])->name('dosen.jurnal.create');
        Route::post('/', [FormJurnalDosenController::class, 'store'])->name('dosen.jurnal.store');
    });
});

