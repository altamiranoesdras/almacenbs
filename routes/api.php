<?php

use App\Http\Controllers\API\OptionAPIController;
use App\Http\Controllers\API\PermissionAPIController;
use App\Http\Controllers\API\RoleAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Support\Facades\Route;

Route::group(['as'=>'api.'], function () {

    Route::resource('options', OptionAPIController::class);



    Route::group(['middleware' => 'auth:api'], function () {

        Route::resource('permissions', PermissionAPIController::class);

        Route::resource('roles', RoleAPIController::class);

        Route::resource('users', UserAPIController::class);
        Route::get('user/add/shortcut/{user}', [UserAPIController::class,'addShortcut'])->name('users.add_shortcut');
        Route::get('user/remove/shortcut/{user}', [UserAPIController::class,'removeShortcut'])->name('users.remove_shortcut');


        Route::resource('compra_estados', App\Http\Controllers\API\CompraEstadoAPIController::class);


        Route::resource('proveedores', App\Http\Controllers\API\ProveedorAPIController::class);


        Route::resource('compra_tipos', App\Http\Controllers\API\CompraTipoAPIController::class);


        Route::resource('compras', App\Http\Controllers\API\CompraAPIController::class);


        Route::resource('item_categorias', App\Http\Controllers\API\ItemCategoriaAPIController::class);


        Route::resource('marcas', App\Http\Controllers\API\MarcaAPIController::class);


        Route::resource('magnituds', App\Http\Controllers\API\MagnitudAPIController::class);


        Route::resource('unimeds', App\Http\Controllers\API\UnimedAPIController::class);


        Route::resource('renglones', App\Http\Controllers\API\RenglonAPIController::class);


        Route::resource('items', App\Http\Controllers\API\ItemAPIController::class);


        Route::resource('compra_detalles', App\Http\Controllers\API\CompraDetalleAPIController::class);


        Route::resource('denominacions', App\Http\Controllers\API\DenominacionAPIController::class);


        Route::resource('divisas', App\Http\Controllers\API\DivisaAPIController::class);


        Route::resource('equivalencias', App\Http\Controllers\API\EquivalenciaAPIController::class);


        Route::resource('stock_inicials', App\Http\Controllers\API\StockInicialAPIController::class);


        Route::resource('item_traslado_estados', App\Http\Controllers\API\ItemTrasladoEstadoAPIController::class);


        Route::resource('item_traslados', App\Http\Controllers\API\ItemTrasladoAPIController::class);


        Route::resource('kardexes', App\Http\Controllers\API\KardexAPIController::class);


        Route::resource('solicitud_estados', App\Http\Controllers\API\SolicitudEstadoAPIController::class);


        Route::resource('rrhh_unidads', App\Http\Controllers\API\RrhhUnidadAPIController::class);


        Route::resource('solicituds', App\Http\Controllers\API\SolicitudAPIController::class);


        Route::resource('solicitud_detalles', App\Http\Controllers\API\SolicitudDetalleAPIController::class);


        Route::resource('stocks', App\Http\Controllers\API\StockAPIController::class);


        Route::resource('stock_transaccions', App\Http\Controllers\API\StockTransaccionAPIController::class);


        Route::resource('user_despacha_users', App\Http\Controllers\API\UserDespachaUserAPIController::class);


        Route::resource('envio_fiscals', App\Http\Controllers\API\EnvioFiscalAPIController::class);


        Route::resource('compra1hs', App\Http\Controllers\API\Compra1hAPIController::class);


        Route::resource('compra1h_detalles', App\Http\Controllers\API\Compra1hDetalleAPIController::class);

    });


});

