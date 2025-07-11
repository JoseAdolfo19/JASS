<?php

use App\Http\Controllers\Admin\AsociadoController;
use App\Http\Controllers\Admin\InicidenciaController;
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
    Route::resource('Asociado', AsociadoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.asociados');
    Route::resource('Incidencia', InicidenciaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.incidencia');
});

require __DIR__.'/auth.php';
