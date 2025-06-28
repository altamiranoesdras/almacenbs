<?php


use App\Http\Controllers\CompraSolicitudController;
use App\Http\Controllers\CompraSolicitudEstadoController;




//grupo de rutas con prefix compra/solicitudes
Route::prefix('compra/requisiciones')->name('compra.requisiciones.')->group(function () {

    Route::get('/nueva', [CompraSolicitudController::class, 'create'])->name('nueva');
    Route::get('/', [CompraSolicitudController::class, 'index'])->name('index');
    Route::get('/create', [CompraSolicitudController::class, 'create'])->name('create');
    Route::post('/', [CompraSolicitudController::class, 'store'])->name('store');
    Route::get('/{compraSolicitud}', [CompraSolicitudController::class, 'show'])->name('show');
    Route::get('/{compraSolicitud}/edit', [CompraSolicitudController::class, 'edit'])->name('edit');
    Route::match(['put', 'patch'], '/{compraSolicitud}', [CompraSolicitudController::class, 'update'])->name('update');
    Route::delete('/{compraSolicitud}', [CompraSolicitudController::class, 'destroy'])->name('destroy');

    Route::post('anular/{compraSolicitud}', [CompraSolicitudController::class,'anular'])->name('anular');
    Route::get('pdf/vista/{compraSolicitud}', [CompraSolicitudController::class,'pdfVista'])->name('pdf.vista');
    Route::get('pdf/{compraSolicitud}', [CompraSolicitudController::class,'pdf'])->name('pdf');



});


Route::resource('compraSolicitudEstados', CompraSolicitudEstadoController::class);
