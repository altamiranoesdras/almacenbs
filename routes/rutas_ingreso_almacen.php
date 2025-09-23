<?php


use App\Http\Controllers\Compra1hAprobadorController;
use App\Http\Controllers\Compra1hAutorizadorController;
use App\Http\Controllers\Compra1hOperadorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionAprobarController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionAutorizarController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionController;
use App\Http\Controllers\CompraRequisicion\CompraRequisicionUsuarioController;
use App\Http\Controllers\CompraSolicitudController;
use App\Http\Controllers\CompraSolicitudEstadoController;
use App\Http\Controllers\SolicitudesCompra\CompraSolicitudConsolidarController;
use App\Http\Controllers\SolicitudesCompra\CompraSolicitudUsuarioController;


Route::prefix('compras')->name('compras.')->group(function () {

    Route::get('ingreso/{id}',[CompraController::class,'ingreso'])->name('ingreso');
    Route::post('anular/{compra}', [CompraController::class,'anular'])->name('anular');
    Route::get('factura/pdf/{compra}', [CompraController::class,'pdf'])->name('pdf');
    Route::get('h1/pdf/{compra}', [CompraController::class,'pdfH1'])->name('h1.pdf');
    Route::get('h1/pdf/digital/{compra}', [CompraController::class,'pdfH1Digital'])->name('h1.pdf.digital');
    Route::post('actualizar/1h/{compra}',[CompraController::class,'actualizar1h'])->name('actualiza.1h');
    Route::post('generar/1h/{compra}',[CompraController::class,'generar1h'])->name('generar.1h');

    Route::post('compras/actualizar/procesada/{compra}', [CompraController::class,'actualizarProcesada'])->name('actualizar.procesada');



});

Route::group(['prefix' => 'bandejas/compras1h', 'as' => 'bandejas.compras1h.'], function () {

    Route::get('operador', [Compra1hOperadorController::class,'index'])->name('operador');
    Route::get('aprobador', [Compra1hAprobadorController::class,'index'])->name('aprobador');
    Route::get('autorizador', [Compra1hAutorizadorController::class,'index'])->name('autorizador');

    Route::get('operador/{compra}', [Compra1hOperadorController::class,'gestionar'])->name('operador.gestionar');
    Route::post('operador/genera1h/{compra}', [Compra1hOperadorController::class,'genera1h'])->name('operador.genera1h');
    Route::post('operador/{compra}', [Compra1hOperadorController::class,'procesar'])->name('operador.procesar');

    Route::get('aprobar/{compra}', [Compra1hAprobadorController::class,'gestionar'])->name('aprobar.gestionar');
    Route::post('aprobar/{compra}', [Compra1hAprobadorController::class,'procesar'])->name('aprobar.procesar');

    Route::get('autorizar/{compra}', [Compra1hAutorizadorController::class,'gestionar'])->name('autorizar.gestionar');
    Route::post('autorizar/{compra}', [Compra1hAutorizadorController::class,'procesar'])->name('autorizar.procesar');
});

Route::resource('compras', CompraController::class);


