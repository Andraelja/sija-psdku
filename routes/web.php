<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;

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

Route::get('/', function () {
    return view('admin.dashboard');
});

//mahasiswa
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
Route::get('/admin/mahasiswa/create', action: [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
Route::post('/admin/mahasiswa', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
Route::get('/admin/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
Route::put('/admin/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
Route::delete('/admin/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');

//dosen
Route::get('/admin/dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
Route::get('/admin/dosen/create', action: [DosenController::class, 'create'])->name('admin.dosen.create');
Route::post('/admin/dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
Route::get('/admin/dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
Route::put('/admin/dosen/{id}', [DosenController::class, 'update'])->name('admin.dosen.update');
Route::delete('/admin/dosen/{id}', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
