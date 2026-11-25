<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AsetController;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Staff;
use App\Models\Aset;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Manajemen Kos & Properti (Integrated)
|--------------------------------------------------------------------------
*/

// Redirect halaman utama ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// 1. Rute Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 2. Rute Authenticated (Semua Role: Admin, Staff, Penghuni)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Bersama
    Route::get('/dashboard', function () {
        $totalKamar = Kamar::count();
        $totalPenghuni = Penghuni::count();
        $totalStaff = Staff::count();
        $totalAset = Aset::count();
        return view('dashboard', compact('totalKamar', 'totalPenghuni', 'totalStaff', 'totalAset'));
    })->name('dashboard');

    // --- CASE A: MASTER KAMAR ---
    // Semua user terdaftar boleh melihat daftar kamar
    Route::get('/kamars', [KamarController::class, 'index'])->name('kamars.index');
    // Hanya Admin yang boleh tambah, edit, hapus kamar
    Route::middleware('role:admin')->group(function () {
        Route::get('/kamars/create', [KamarController::class, 'create'])->name('kamars.create');
        Route::post('/kamars', [KamarController::class, 'store'])->name('kamars.store');
        Route::get('/kamars/{kamar}/edit', [KamarController::class, 'edit'])->name('kamars.edit');
        Route::put('/kamars/{kamar}', [KamarController::class, 'update'])->name('kamars.update');
        Route::delete('/kamars/{kamar}', [KamarController::class, 'destroy'])->name('kamars.destroy');
    });

    // --- CASE B: DATA PENGHUNI ---
    // Semua user terdaftar boleh melihat data penghuni
    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
    // Hanya Admin yang boleh tambah, edit, hapus penghuni
    Route::middleware('role:admin')->group(function () {
        Route::get('/penghuni/create', [PenghuniController::class, 'create'])->name('penghuni.create');
        Route::post('/penghuni', [PenghuniController::class, 'store'])->name('penghuni.store');
        Route::get('/penghuni/{penghuni}/edit', [PenghuniController::class, 'edit'])->name('penghuni.edit');
        Route::put('/penghuni/{penghuni}', [PenghuniController::class, 'update'])->name('penghuni.update');
        Route::delete('/penghuni/{penghuni}', [PenghuniController::class, 'destroy'])->name('penghuni.destroy');
    });

    // --- CASE C: HOUSEKEEPER / STAFF ---
    // Semua user terdaftar boleh melihat daftar staff/jadwal piket
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    // Admin dan Staff yang boleh mengelola tugas & data staff
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
    });

    // --- CASE D: INVENTARIS ASET ---
    // Semua user boleh melihat inventaris
    Route::get('/asets', [AsetController::class, 'index'])->name('asets.index');
    // Admin dan Staff boleh mengelola inventaris aset
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/asets/create', [AsetController::class, 'create'])->name('asets.create');
        Route::post('/asets', [AsetController::class, 'store'])->name('asets.store');
        Route::get('/asets/{aset}/edit', [AsetController::class, 'edit'])->name('asets.edit');
        Route::put('/asets/{aset}', [AsetController::class, 'update'])->name('asets.update');
        Route::delete('/asets/{aset}', [AsetController::class, 'destroy'])->name('asets.destroy');
    });
});
