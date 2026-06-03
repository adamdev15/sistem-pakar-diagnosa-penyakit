<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Master Data
    Route::resource('penyakit', PenyakitController::class);
    Route::post('penyakit/import', [PenyakitController::class, 'import'])->name('penyakit.import');
    Route::get('penyakit-template', [PenyakitController::class, 'downloadTemplate'])->name('penyakit.template');

    Route::resource('gejala', GejalaController::class);
    Route::post('gejala/import', [GejalaController::class, 'import'])->name('gejala.import');
    Route::get('gejala-template', [GejalaController::class, 'downloadTemplate'])->name('gejala.template');

    Route::resource('aturan', AturanController::class);

    // User Management
    Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);

    // Diagnosa & Laporan
    Route::resource('diagnosa', DiagnosaController::class);
    Route::resource('laporan', LaporanController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
