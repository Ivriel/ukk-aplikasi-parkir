<?php

use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tarifs', TarifController::class)->except('show')->middleware('role:admin');
    Route::resource('areaParkirs', AreaParkirController::class)->except('show')->middleware('role:admin');
    Route::resource('kendaraans', KendaraanController::class)->except('show')->middleware('role:admin');
    Route::get('logs', [LogController::class, 'index'])->name('logs.index')->middleware('role:admin');
    Route::resource('transaksis', TransactionController::class)->except('destroy')->middleware('role:petugas,owner');
    Route::get('/transaksis/print/{id}', [TransactionController::class, 'printStruk'])->name('transaksis.print')->middleware('role:petugas');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
