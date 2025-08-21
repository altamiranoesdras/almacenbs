<?php

use App\Http\Controllers\API\ActivoAPIController;
use App\Http\Controllers\API\ActivoEstadoAPIController;
use App\Http\Controllers\API\ActivoSolicitudAPIController;
use App\Http\Controllers\API\ActivoSolicitudDetalleAPIController;
use App\Http\Controllers\API\ActivoSolicitudEstadoAPIController;
use App\Http\Controllers\API\ActivoSolicitudTipoAPIController;
use App\Http\Controllers\API\ActivoTarjetaAPIController;
use App\Http\Controllers\API\ActivoTarjetaDetalleAPIController;
use App\Http\Controllers\API\ActivoTipoAPIController;
use App\Http\Controllers\API\Compra1hAPIController;
use App\Http\Controllers\API\Compra1hDetalleAPIController;
use App\Http\Controllers\API\CompraAPIController;
use App\Http\Controllers\API\CompraDetalleAPIController;
use App\Http\Controllers\API\CompraEstadoAPIController;
use App\Http\Controllers\API\CompraTipoAPIController;
use App\Http\Controllers\API\DenominacionAPIController;
use App\Http\Controllers\API\DivisaAPIController;
use App\Http\Controllers\API\EnvioFiscalAPIController;
use App\Http\Controllers\API\EquivalenciaAPIController;
use App\Http\Controllers\API\ItemAPIController;
use App\Http\Controllers\API\ItemCategoriaAPIController;
use App\Http\Controllers\API\ItemTipoAPIController;
use App\Http\Controllers\API\ItemTrasladoAPIController;
use App\Http\Controllers\API\ItemTrasladoEstadoAPIController;
use App\Http\Controllers\API\KardexAPIController;
use App\Http\Controllers\API\MagnitudAPIController;
use App\Http\Controllers\API\MarcaAPIController;
use App\Http\Controllers\API\OptionAPIController;
use App\Http\Controllers\API\PermissionAPIController;
use App\Http\Controllers\API\ProveedorAPIController;
use App\Http\Controllers\API\RenglonAPIController;
use App\Http\Controllers\API\RoleAPIController;
use App\Http\Controllers\API\RrhhPuestoAPIController;
use App\Http\Controllers\API\RrhhUnidadAPIController;
use App\Http\Controllers\API\SolicitudAPIController;
use App\Http\Controllers\API\SolicitudDetalleAPIController;
use App\Http\Controllers\API\SolicitudEstadoAPIController;
use App\Http\Controllers\API\StockAPIController;
use App\Http\Controllers\API\StockInicialAPIController;
use App\Http\Controllers\API\StockTransaccionAPIController;
use App\Http\Controllers\API\UnimedAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\UserDespachaUserAPIController;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'api.'], function () {

    Route::resource('options', OptionAPIController::class);



    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::resource('permissions', PermissionAPIController::class);

        Route::resource('roles', RoleAPIController::class);

        Route::post('user/add/shortcut/{user}', [UserAPIController::class,'addShortcut'])->name('users.add_shortcut');
        Route::post('user/remove/shortcut/{user}', [UserAPIController::class,'removeShortcut'])->name('users.remove_shortcut');
        Route::resource('users', UserAPIController::class);


        Route::resource('compra_estados', CompraEstadoAPIController::class);


        Route::resource('proveedores', ProveedorAPIController::class);


        Route::resource('compra_tipos', CompraTipoAPIController::class);


        Route::resource('compras', CompraAPIController::class);


        Route::resource('item_categorias', ItemCategoriaAPIController::class);


        Route::resource('marcas', MarcaAPIController::class);


        Route::resource('magnitudes', MagnitudAPIController::class);


        Route::resource('unimeds', UnimedAPIController::class);


        Route::resource('renglones', RenglonAPIController::class);


        Route::resource('items', ItemAPIController::class);
        Route::get('equivalencias/item/{item}', [EquivalenciaAPIController::class,'item'])->name('equivalencia.item');
        Route::resource('equivalencias', EquivalenciaAPIController::class);

        Route::resource('compra_detalles', CompraDetalleAPIController::class);


        Route::resource('denominacions', DenominacionAPIController::class);


        Route::resource('divisas', DivisaAPIController::class);




        Route::resource('stock_inicials', StockInicialAPIController::class);


        Route::resource('item_traslado_estados', ItemTrasladoEstadoAPIController::class);


        Route::resource('item_traslados', ItemTrasladoAPIController::class);


        Route::resource('kardexes', KardexAPIController::class);
        Route::post('kardexes/ordenar/filas', [KardexAPIController::class,'ordenarFilas'])->name('kardexes.ordenar_filas');


        Route::resource('solicitud_estados', SolicitudEstadoAPIController::class);


        Route::resource('rrhh_unidades', RrhhUnidadAPIController::class);
        Route::resource('rrhh_puestos', RrhhPuestoAPIController::class);


        Route::resource('solicitudes', SolicitudAPIController::class);


        Route::resource('solicitud_detalles', SolicitudDetalleAPIController::class);


        Route::resource('stocks', StockAPIController::class);


        Route::resource('stock_transaccions', StockTransaccionAPIController::class);


        Route::resource('user_despacha_users', UserDespachaUserAPIController::class);


        Route::resource('envio_fiscals', EnvioFiscalAPIController::class);


        Route::resource('compra1hs', Compra1hAPIController::class);


        Route::resource('compra1h_detalles', Compra1hDetalleAPIController::class);


        Route::resource('item_tipos', ItemTipoAPIController::class);


        Route::resource('activo_estados', ActivoEstadoAPIController::class);


        Route::resource('activo_tipos', ActivoTipoAPIController::class);


        Route::resource('activos', ActivoAPIController::class);


        Route::resource('activo_tarjetas', ActivoTarjetaAPIController::class);


        Route::post('activo_tarjeta_detalles/dar/baja/{detalle}', [ActivoTarjetaDetalleAPIController::class,'darBaja'])->name('activo_tarjeta_detalles.baja');
        Route::resource('activo_tarjeta_detalles', ActivoTarjetaDetalleAPIController::class);


        Route::resource('activo_solicitud_tipos', ActivoSolicitudTipoAPIController::class);


        Route::resource('activo_solicitud_estados', ActivoSolicitudEstadoAPIController::class);


        Route::resource('activo_solicituds', ActivoSolicitudAPIController::class);


        Route::resource('activo_solicitud_detalles', ActivoSolicitudDetalleAPIController::class);

        Route::resource('colaboradores', App\Http\Controllers\API\ColaboradorAPIController::class);


        Route::resource('contratos', App\Http\Controllers\API\ContratoAPIController::class);

        Route::resource('activo_tarjeta_estados', App\Http\Controllers\API\ActivoTarjetaEstadoAPIController::class);

        Route::resource('item_presentaciones', App\Http\Controllers\API\ItemPresentacionAPIController::class);

        Route::resource('rrhh_contratos', App\Http\Controllers\API\RrhhContratoAPIController::class);

        Route::resource('bodegas', App\Http\Controllers\API\BodegaAPIController::class);



        Route::resource('consumo_estados', App\Http\Controllers\API\ConsumoEstadoAPIController::class);


        Route::resource('consumos', App\Http\Controllers\API\ConsumoAPIController::class);


        Route::resource('consumo_detalles', App\Http\Controllers\API\ConsumoDetalleAPIController::class);

        Route::resource('item_modelos', App\Http\Controllers\API\ItemModeloAPIController::class);

        Route::resource('compra_solicitud_detalles', App\Http\Controllers\API\CompraSolicitudDetalleAPIController::class)
            ->except(['create', 'edit']);

        Route::resource('rrhh_unidad_tipos', App\Http\Controllers\API\RrhhUnidadTipoAPIController::class)
            ->except(['create', 'edit']);
//
//
//        Route::resource('compra-requisicion-estados', App\Http\Controllers\API\CompraRequicicionEstadoAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-requisicion-tipo-adquisiciones', App\Http\Controllers\API\CompraRequicicionTipoAdquisicionAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-requisicion-tipo-concursos', App\Http\Controllers\API\CompraRequisicionTipoConcursoAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-requisicions', App\Http\Controllers\API\CompraRequisicionAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-ordens', App\Http\Controllers\API\CompraOrdenAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-orden-detalles', App\Http\Controllers\API\CompraOrdenDetalleAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-solicitud-estados', App\Http\Controllers\API\CompraSolicitudEstadoAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('costo-centros', App\Http\Controllers\API\CostoCentroAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('rrhh-unidads', App\Http\Controllers\API\RrhhUnidadAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-solicituds', App\Http\Controllers\API\CompraSolicitudAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-requisicion-detalles', App\Http\Controllers\API\CompraRequisicionDetalleAPIController::class)
//            ->except(['create', 'edit']);
//
//        Route::resource('compra-bandejas', App\Http\Controllers\API\CompraBandejaAPIController::class)
//            ->except(['create', 'edit']);

    });


});

