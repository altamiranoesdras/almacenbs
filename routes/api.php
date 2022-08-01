<?php

use App\Http\Controllers\API\OptionAPIController;
use App\Http\Controllers\API\PermissionAPIController;
use App\Http\Controllers\API\RoleAPIController;
use App\Http\Controllers\API\UserAPIController;

use App\Http\Controllers\API\CompraEstadoAPIController;
use App\Http\Controllers\API\ProveedorAPIController;
use App\Http\Controllers\API\CompraTipoAPIController;
use App\Http\Controllers\API\CompraAPIController;
use App\Http\Controllers\API\ItemCategoriaAPIController;
use App\Http\Controllers\API\MarcaAPIController;
use App\Http\Controllers\API\MagnitudAPIController;
use App\Http\Controllers\API\UnimedAPIController;
use App\Http\Controllers\API\RenglonAPIController;
use App\Http\Controllers\API\ItemAPIController;
use App\Http\Controllers\API\CompraDetalleAPIController;
use App\Http\Controllers\API\DenominacionAPIController;
use App\Http\Controllers\API\DivisaAPIController;
use App\Http\Controllers\API\EquivalenciaAPIController;
use App\Http\Controllers\API\StockInicialAPIController;
use App\Http\Controllers\API\ItemTrasladoEstadoAPIController;
use App\Http\Controllers\API\ItemTrasladoAPIController;
use App\Http\Controllers\API\KardexAPIController;
use App\Http\Controllers\API\SolicitudEstadoAPIController;
use App\Http\Controllers\API\RrhhUnidadAPIController;
use App\Http\Controllers\API\SolicitudAPIController;
use App\Http\Controllers\API\SolicitudDetalleAPIController;
use App\Http\Controllers\API\StockAPIController;
use App\Http\Controllers\API\StockTransaccionAPIController;
use App\Http\Controllers\API\UserDespachaUserAPIController;
use App\Http\Controllers\API\EnvioFiscalAPIController;
use App\Http\Controllers\API\Compra1hAPIController;
use App\Http\Controllers\API\Compra1hDetalleAPIController;

use Illuminate\Support\Facades\Route;

Route::group(['as'=>'api.'], function () {

    Route::resource('options', OptionAPIController::class);



    Route::group(['middleware' => 'auth:api'], function () {

        Route::resource('permissions', PermissionAPIController::class);

        Route::resource('roles', RoleAPIController::class);

        Route::resource('users', UserAPIController::class);
        Route::get('user/add/shortcut/{user}', [UserAPIController::class,'addShortcut'])->name('users.add_shortcut');
        Route::get('user/remove/shortcut/{user}', [UserAPIController::class,'removeShortcut'])->name('users.remove_shortcut');


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


        Route::resource('compra_detalles', CompraDetalleAPIController::class);


        Route::resource('denominacions', DenominacionAPIController::class);


        Route::resource('divisas', DivisaAPIController::class);


        Route::get('equivalencias/item/{item}', [EquivalenciaAPIController::class,'item'])->name('equivalencia.item');
        Route::resource('equivalencias', EquivalenciaAPIController::class);


        Route::resource('stock_inicials', StockInicialAPIController::class);


        Route::resource('item_traslado_estados', ItemTrasladoEstadoAPIController::class);


        Route::resource('item_traslados', ItemTrasladoAPIController::class);


        Route::resource('kardexes', KardexAPIController::class);


        Route::resource('solicitud_estados', SolicitudEstadoAPIController::class);


        Route::resource('rrhh_unidads', RrhhUnidadAPIController::class);


        Route::resource('solicitudes', SolicitudAPIController::class);


        Route::resource('solicitud_detalles', SolicitudDetalleAPIController::class);


        Route::resource('stocks', StockAPIController::class);


        Route::resource('stock_transaccions', StockTransaccionAPIController::class);


        Route::resource('user_despacha_users', UserDespachaUserAPIController::class);


        Route::resource('envio_fiscals', EnvioFiscalAPIController::class);


        Route::resource('compra1hs', Compra1hAPIController::class);


        Route::resource('compra1h_detalles', Compra1hDetalleAPIController::class);

    });


});

