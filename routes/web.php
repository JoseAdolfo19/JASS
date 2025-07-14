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
    ->middleware(['auth', 'verified', 'can:admin.dashboard'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('asociados', AsociadoController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.asociados')
        ->middleware('can:admin.asociados.index');
    Route::get('asociados/export-pdf', [AsociadoController::class, 'exportPdf'])
        ->name('admin.asociados.export-pdf')
        ->middleware('can:admin.asociados.export-pdf');

    Route::resource('gastoproductos', GastoProductosController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.gastoproductos')
        ->middleware('can:admin.gastoproductos.index');
    Route::get('gastoproductos/export-excel', [GastoProductosController::class, 'exportExcel'])
        ->name('admin.gastoproductos.export-excel');

    Route::resource('reportes', ReportarIncidenciaController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.reported_incidence')
        ->middleware('can:admin.reported_incidence.index');
    Route::get('reportes/export-pdf', [ReportarIncidenciaController::class, 'exportPdf'])
        ->name('admin.reported_incidence.export-pdf')
        ->middleware('can:admin.reported_incidence.export-pdf');

    Route::resource('pagos', PagoCuotasController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.pago_cuotas')
        ->middleware('can:admin.pago_cuotas.index');
    Route::get('pagos/export-excel', [PagoCuotasController::class, 'exportExcel'])
        ->name('admin.pago_cuotas.export-excel')
        ->middleware('can:admin.pago_cuotas.export-excel');

});


require __DIR__.'/auth.php';
