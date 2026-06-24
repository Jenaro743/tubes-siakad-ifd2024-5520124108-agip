<?php

use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dosen/export', [DosenController::class, 'export'])->name('dosen.export');
    Route::resource('dosen', DosenController::class);
    Route::get('mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('mata-kuliah/export', [MataKuliahController::class, 'export'])->name('mata-kuliah.export');
    Route::resource('mata-kuliah', MataKuliahController::class)->parameters(['mata-kuliah' => 'mataKuliah']);
    Route::get('jadwal/export', [AdminJadwalController::class, 'export'])->name('jadwal.export');
    Route::resource('jadwal', AdminJadwalController::class);
});

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('krs/cetak', [KrsController::class, 'print'])->name('krs.print');
    Route::resource('krs', KrsController::class)->only(['index', 'store', 'destroy']);
    Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('profile', [MahasiswaProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [MahasiswaProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
