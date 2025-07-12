<?php

use App\Http\Controllers\Admin\AsociadoController;
use App\Http\Controllers\Admin\GastoProductosController;
use App\Http\Controllers\Admin\PagoCuotasController;
use App\Http\Controllers\Admin\ReportarIncidenciaController;
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
    Route::resource('asociados', AsociadoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.asociados');
    Route::get('asociados/export-pdf', [AsociadoController::class, 'exportPdf'])->name('admin.asociados.export-pdf'); 
    Route::resource('gastoproductos', GastoProductosController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.gastoproductos');
    Route::get('gastoproductos/export-excel', [GastoProductosController::class, 'exportExcel'])->name('admin.gastoproductos.export-excel');
    Route::resource('reportes', ReportarIncidenciaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.reported_incidence');
    Route::get('reportes/export-pdf', [ReportarIncidenciaController::class, 'exportPdf'])->name('admin.reported_incidence.export-pdf');
    Route::resource('pagos', PagoCuotasController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.pago_cuotas');
    Route::get('pagos/export-excel', [PagoCuotasController::class, 'exportExcel'])->name('admin.pago_cuotas.export-excel');

});


require __DIR__.'/auth.php';
