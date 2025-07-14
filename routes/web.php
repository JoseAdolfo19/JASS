<?php

use App\Http\Controllers\Admin\AsociadoController;
use App\Http\Controllers\Admin\GastoProductosController;
use App\Http\Controllers\Admin\PagoCuotasController;
use App\Http\Controllers\Admin\ReportarIncidenciaController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\ComunalAssemblyController; // Asegúrate de que el namespace sea correcto
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'can:dashboard.view'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::prefix('admin')->group(function () {
    Route::resource('asociados', AsociadoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.asociados')->middleware('can:admin.asociados.index');
Route::get('asociados/export-pdf', [AsociadoController::class, 'exportPdf'])->name('admin.asociados.export-pdf')->middleware('can:admin.asociados.export-pdf');

    Route::resource('gastoproductos', GastoProductosController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.gastoproductos')->middleware('can:admin.gatoproductos.index');
Route::get('gatoproductos/export-pdf', [GastoProductosController::class, 'exportPdf'])->name('admin.gastoproductos.export-pdf')->middleware('can:admin.gatoproductos6.export-pdf');

    Route::resource('reportes', ReportarIncidenciaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.reported_incidence')->middleware('can:admin.reported_inicidence.index');
    Route::resource('pago', PagoCuotasController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.pago_cuotas')->middleware('can:admin.pago_cuotas.index');
    Route::resource('task', TaskController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.task')->middleware('can:admin.task.index');
    Route::resource('comunalassembly', ComunalAssemblyController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.comunalassembly')->middleware('can:admin.comunalassembly.index');
    
    
    // Cambia 'task' a 'comunalassemblies' o algo similar
    //Route::resource('comunalassemblies', ComunalAssemblyController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.comunalassemblies');
});

// Route::get('asociados/export-pdf', [AsociadoController::class, 'exportPdf'])->name('admin.asociados.export-pdf');
// Route::get('gatoproductos/export-pdf', [GastoProductosController::class, 'exportPdf'])->name('admin.gastoproductos.export-pdf');

require __DIR__.'/auth.php';