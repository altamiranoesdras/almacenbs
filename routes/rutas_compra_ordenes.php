<?php


use App\Http\Controllers\CompraSolicitudController;
use App\Http\Controllers\CompraSolicitudEstadoController;

Route::resource('compraSolicitudes', CompraSolicitudController::class);

//grupo de rutas con prefix compra/solicitudes
Route::prefix('compra/solicitudes')->name('compra.solicitudes.')->group(function () {

    Route::post('anular/{compraSolicitud}', [CompraSolicitudController::class,'anular'])->name('anular');
    Route::get('pdf/vista/{compraSolicitud}', [CompraSolicitudController::class,'pdfVista'])->name('pdf.vista');
    Route::get('pdf/{compraSolicitud}', [CompraSolicitudController::class,'pdf'])->name('pdf');

});

Route::resource('compraSolicitudEstados', CompraSolicitudEstadoController::class);
