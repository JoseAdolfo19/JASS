<?php

use App\Http\Controllers\Admin\AsociadoController;
use App\Http\Controllers\Admin\GastoProductosController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::prefix('admin')->group(function () {
<<<<<<< HEAD
    Route::resource('asociados', AsociadoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.asociados');
    Route::resource('gastoproductos', GastoProductosController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.gastoproductos');
=======
    Route::resource('Asociado', AsociadoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.asociados');
>>>>>>> main
});

require __DIR__.'/auth.php';
