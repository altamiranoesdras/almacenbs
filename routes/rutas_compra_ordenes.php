<?php


use App\Http\Controllers\CompraRequisicionController;
use App\Http\Controllers\CompraSolicitudController;
use App\Http\Controllers\CompraSolicitudEstadoController;
use App\Http\Controllers\SolicitudesCompra\CompraSolicitudAprobarController;
use App\Http\Controllers\SolicitudesCompra\CompraSolicitudUsuarioController;




Route::prefix('compra')->name('compra.')->group(function () {

    Route::resource('bandejas', App\Http\Controllers\CompraBandejaController::class);


    Route::prefix('requisiciones')->name('requisiciones.')->group(function () {

        Route::resource('estados', App\Http\Controllers\CompraRequicicionEstadoController::class);
        Route::resource('tipo-adquisicions', App\Http\Controllers\CompraRequicicionTipoAdquisicionController::class);
        Route::resource('tipo-concursos', App\Http\Controllers\CompraRequisicionTipoConcursoController::class);


        Route::get('requisicions', [CompraRequisicionController::class, 'index'])->name('requisicions.index');
        Route::get('requisicions/create', [CompraRequisicionController::class, 'create'])->name('requisicions.create');
        Route::post('requisicions', [CompraRequisicionController::class, 'store'])->name('requisicions.store');
        Route::get('requisicions/{requisicion}', [CompraRequisicionController::class, 'show'])->name('requisicions.show');
        Route::get('requisicions/{requisicion}/edit', [CompraRequisicionController::class, 'edit'])->name('requisicions.edit');
        Route::put('requisicions/{requisicion}', [CompraRequisicionController::class, 'update'])->name('requisicions.update');
        Route::patch('requisicions/{requisicion}', [CompraRequisicionController::class, 'update']);
        Route::delete('requisicions/{requisicion}', [CompraRequisicionController::class, 'destroy'])->name('requisicions.destroy');

    });


    Route::resource('ordens', App\Http\Controllers\CompraOrdenController::class);
    Route::resource('orden-detalles', App\Http\Controllers\CompraOrdenDetalleController::class);
//    Route::resource('solicitud-estados', App\Http\Controllers\CompraSolicitudEstadoController::class);
//    Route::resource('solicituds', App\Http\Controllers\CompraSolicitudController::class);
//    Route::resource('solicitud-detalles', App\Http\Controllers\CompraSolicitudDetalleController::class);
    Route::resource('requisicion-detalles', App\Http\Controllers\CompraRequisicionDetalleController::class);


});


//grupo de rutas con prefix compra/solicitudes
Route::prefix('compra/solicitudes')->name('compra.solicitudes.')->group(function () {

    Route::get('/mis/solicitudes', [CompraSolicitudUsuarioController::class, 'index'])->name('usuario');
    Route::get('/aprobar', [CompraSolicitudAprobarController::class, 'index'])->name('aprobar');

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
