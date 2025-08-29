<?php


use App\Http\Controllers\CompraRequisicion\CompraRequisicionAprobarController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionAutorizarController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionUsuarioController;
use App\Http\Controllers\CompraSolicitudController;
use App\Http\Controllers\CompraSolicitudEstadoController;
use App\Http\Controllers\SolicitudesCompra\CompraSolicitudConsolidarController;
use App\Http\Controllers\SolicitudesCompra\CompraSolicitudUsuarioController;


Route::prefix('compra')->name('compra.')->group(function () {

    Route::resource('bandejas', App\Http\Controllers\CompraBandejaController::class);


    Route::prefix('requisiciones')->name('requisiciones.')->group(function () {

        Route::post('solicitante/firmar/imprimir{requisicion}', [CompraRequisicionController::class,'solicitanteFirmarEImprimir'])->name('solicitante.firmar.imprimir');
        Route::post('aprobador/firmar/imprimir{requisicion}', [CompraRequisicionAprobarController::class,'aprobadorFirmarEImprimir'])->name('aprobador.firmar.imprimir');

        Route::resource('estados', App\Http\Controllers\CompraRequicicionEstadoController::class);
        Route::resource('tipo-adquisiciones', App\Http\Controllers\CompraRequicicionTipoAdquisicionController::class);
        Route::resource('tipo-concursos', App\Http\Controllers\CompraRequisicionTipoConcursoController::class);

        Route::get('mis/requisiciones', [CompraRequisicionUsuarioController::class, 'index'])->name('mis.requisiciones');
        Route::get('aprobar', [CompraRequisicionAprobarController::class, 'index'])->name('aprobar');
        Route::get('aprobar/seguimiento/{requisicion}', [CompraRequisicionAprobarController::class, 'seguimiento'])->name('aprobar.seguimiento');
        Route::get('autorizar', [CompraRequisicionAutorizarController::class, 'index'])->name('autorizar');

        Route::get('requisiciones', [CompraRequisicionController::class, 'index'])->name('requisiciones.index');
        Route::get('requisiciones/create', [CompraRequisicionController::class, 'create'])->name('requisiciones.create');
        Route::post('requisiciones', [CompraRequisicionController::class, 'store'])->name('requisiciones.store');
        Route::get('requisiciones/{requisicion}', [CompraRequisicionController::class, 'show'])->name('requisiciones.show');
        Route::get('requisiciones/{requisicion}/edit', [CompraRequisicionController::class, 'edit'])->name('requisiciones.edit');
        Route::put('requisiciones/{requisicion}', [CompraRequisicionController::class, 'update'])->name('requisiciones.update');
        Route::patch('requisiciones/{requisicion}', [CompraRequisicionController::class, 'update']);
        Route::delete('requisiciones/{requisicion}', [CompraRequisicionController::class, 'destroy'])->name('requisiciones.destroy');


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

    Route::resource('estados', CompraSolicitudEstadoController::class);

    Route::get('/mis/solicitudes', [CompraSolicitudUsuarioController::class, 'index'])->name('usuario');
    Route::get('/consolidar', [CompraSolicitudConsolidarController::class, 'index'])->name('consolidar');
    Route::post('/consolidar/store', [CompraSolicitudConsolidarController::class, 'consolidarSolicitudes'])->name('consolidar.store');

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
//    Route::get('pdf/{compraSolicitud}', [CompraSolicitudController::class,'pdf'])->name('pdf');
});

