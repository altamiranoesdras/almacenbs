<?php

use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\LibroAlamcenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DivisaController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\UnimedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RenglonController;
use App\Http\Controllers\Compra1hController;
use App\Http\Controllers\ItemTipoController;
use App\Http\Controllers\MagnitudController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompraTipoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RrhhPuestoController;
use App\Http\Controllers\RrhhUnidadController;
use App\Http\Controllers\EnvioFiscalController;
use App\Http\Controllers\CompraEstadoController;
use App\Http\Controllers\DenominacionController;
use App\Http\Controllers\EquivalenciaController;
use App\Http\Controllers\ItemTrasladoController;
use App\Http\Controllers\StockInicialController;
use App\Http\Controllers\CompraDetalleController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ItemCategoriaController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\Compra1hDetalleController;
use App\Http\Controllers\PassportClientsController;
use App\Http\Controllers\ReportesAlmacenController;
use App\Http\Controllers\SolicitudEstadoController;
use App\Http\Controllers\SolicitudApruebaController;
use App\Http\Controllers\SolicitudDetalleController;
use App\Http\Controllers\StockTransaccionController;
use App\Http\Controllers\UserDespachaUserController;
use App\Http\Controllers\SolicitudAutorizaController;
use App\Http\Controllers\SolicitudDespachaController;
use App\Http\Controllers\ItemTrasladoEstadoController;

use App\Http\Controllers\ActivoEstadoController;
use App\Http\Controllers\ActivoTipoController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\ActivoTarjetaController;
use App\Http\Controllers\ActivoTarjetaDetalleController;
use App\Http\Controllers\ActivoSolicitudTipoController;
use App\Http\Controllers\ActivoSolicitudEstadoController;
use App\Http\Controllers\ActivoSolicitudController;
use App\Http\Controllers\ActivoSolicitudDetalleController;

Auth::routes(['verify' => true]);

Route::get('login/{driver}', [LoginController::class,'redirectToProvider'])->name('social_auth');
Route::get('login/{driver}/callback', [LoginController::class,'handleProviderCallback']);



/**
 * Rutas admin
 */
Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {


    Route::group(['as' => 'admin.'],function (){

        Route::get('/', [HomeAdminController::class,'index'])->name('index');
        Route::get('/home', [HomeAdminController::class,'index'])->name('home');
        Route::get('/dashboard', [HomeAdminController::class,'dashboard'])->name('dashboard');
        Route::get('/calendar', [HomeAdminController::class,'calendar'])->name('calendar');

    });

    Route::group(['prefix' => 'dev','as' => 'dev.'],function (){

        Route::get('prueba/api',[PruebaApiController::class,'index'])->name('prueba.api');

        Route::get('passport/clients', [PassportClientsController::class,'index'])->name('passport.clients');

        Route::resource('configurations', ConfigurationController::class);

    });



    Route::get('profile/business', [BusinessProfileController::class,'index'])->name('profile.business');
    Route::post('profile/business', [BusinessProfileController::class,'store'])->name('profile.business.store');

    Route::get('profile', [ProfileController::class,'index'])->name('profile');
    Route::patch('profile/{user}', [ProfileController::class,'update'])->name('profile.update');
    Route::post('profile/{user}/edit/avatar', [ProfileController::class,'editAvatar'])->name('profile.edit.avatar');
    Route::get('profile/{user}/remove/avatar', [ProfileController::class,'removeAvatar'])->name('profile.remove.avatar');


    Route::resource('users', UserController::class);
    Route::get('user/{user}/menu', [UserController::class,'menu'])->name('user.menu');;
    Route::patch('user/menu/{user}', [UserController::class,'menuStore'])->name('users.menuStore');

    Route::get('option/create/{option}', [OptionController::class,'create'])->name('option.create');
    Route::get('option/orden', [OptionController::class,'updateOrden'])->name('option.order.store');
    Route::resource('options',OptionController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);




    Route::resource('compraEstados', CompraEstadoController::class);


    Route::resource('proveedores', ProveedorController::class);

   Route::resource('compraTipos', CompraTipoController::class);


    Route::get('compras/ingreso/{id}',[CompraController::class,'ingreso'])->name('compra.ingreso');
    Route::post('compras/anular/{compra}', [CompraController::class,'anular'])->name('compras.anular');
    Route::get('compras/factura/pdf/{compra}', [CompraController::class,'pdf'])->name('compra.pdf');
    Route::get('compras/h1/pdf/{compra}', [CompraController::class,'pdfH1'])->name('compra.h1.pdf');
    Route::post('comprar/actualizar/1h/{compra}',[CompraController::class,'actualizar1h'])->name('compra.actualiza.1h');
    Route::get('comprar/generar/1h/{compra}',[CompraController::class,'generar1h'])->name('compra.generar.1h');

    Route::post('compras/actualizar/procesada/{compra}', [CompraController::class,'actualizarProcesada'])->name('compras.actualizar.procesada');
    Route::resource('compras', CompraController::class);


    Route::resource('itemCategorias', ItemCategoriaController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('magnitudes', MagnitudController::class);
    Route::resource('unimeds', UnimedController::class);
    Route::resource('renglones', RenglonController::class);


    Route::get('items/import', [ItemController::class,'importar'])->name('items.importar');
    Route::post('items/import', [ItemController::class,'importarStore'])->name('items.importar.store');

    Route::resource('items', ItemController::class);


    Route::resource('compraDetalles', CompraDetalleController::class);


    Route::resource('denominaciones', DenominacionController::class);


    Route::resource('divisas', DivisaController::class);


    Route::resource('equivalencias', EquivalenciaController::class);


    Route::resource('itemTrasladoEstados', ItemTrasladoEstadoController::class);


    Route::post('itemTraslados/anular/{itemTraslado}', [ItemTrasladoController::class,'anular'])->name('itemTraslados.anular');
    Route::resource('itemTraslados', ItemTrasladoController::class);




    Route::resource('solicitudEstados', SolicitudEstadoController::class);


    Route::resource('rrhhUnidades', RrhhUnidadController::class);

    Route::resource('colaboradores', ColaboradorController::class);

    Route::resource('rrhhContratos', App\Http\Controllers\RrhhContratoController::class);

    Route::resource('contratos', ContratoController::class);



    Route::any('/solicitudes/preimpreso/{solicitud}', [SolicitudController::class,'preimpreso'])->name('solicitudes.preimpreso');

    Route::any('/solicitudes/despachoPdf/{solicitud}', [SolicitudController::class,'despachoPdf'])->name('solicitudes.despachoPdf');

    Route::get('mis/solicitudes', [SolicitudController::class,'user'])->name('solicitudes.usuario');

    Route::get('solicitudes/autorizar', [SolicitudAutorizaController::class,'index'])->name('solicitudes.autorizar');
    Route::get('solicitudes/autorizar/{solicitud}', [SolicitudAutorizaController::class,'store'])->name('solicitudes.autorizar.store');

    Route::get('solicitudes/aprobar', [SolicitudApruebaController::class,'index'])->name('solicitudes.aprobar');
    Route::post('solicitudes/aprobar/{solicitud}', [SolicitudApruebaController::class,'store'])->name('solicitudes.aprobar.store');

    Route::get('solicitudes/despachar', [SolicitudDespachaController::class,'index'])->name('solicitudes.despachar');
    Route::post('solicitudes/despachar/{solicitud}', [SolicitudDespachaController::class,'store'])->name('solicitudes.despachar.store');

    Route::get('solicitudes/cancelar/{solicitud}', [SolicitudController::class,'cancelar'])->name('solicitudes.cancelar');
    Route::post('solicitudes/anular/{solicitud}', [SolicitudController::class,'anular'])->name('solicitudes.anular');

    Route::resource('solicitudes', SolicitudController::class);


    Route::resource('userDespachaUsers', UserDespachaUserController::class);


    Route::resource('envioFiscals', EnvioFiscalController::class);


    Route::resource('compra1hs', Compra1hController::class);

    Route::resource('rrhhPuestos', RrhhPuestoController::class);

    Route::resource('itemTipos', ItemTipoController::class);

    Route::resource('itemPresentaciones', App\Http\Controllers\ItemPresentacionController::class);


    Route::get('reportes/kardex', [ReportesAlmacenController::class,'kardex'])->name('reportes.kardex');
    Route::get('reportes/stock', [ReportesAlmacenController::class,'stock'])->name('reportes.stock');
    Route::get('reportes/items/vencen', [ReportesAlmacenController::class,'itemsAvencer'])->name('reportes.items.vencen');

    Route::get('comparas/libro/almacen/pdf', [LibroAlamcenController::class,'pdf'])->name('comparas.libro.almacen.pdf');
    Route::get('comparas/libro/almacen', [LibroAlamcenController::class,'index'])->name('comparas.libro.almacen');

    Route::group(['prefix' => 'inventarios'], function () {
        Route::resource('activoEstados', ActivoEstadoController::class);


        Route::resource('activoTipos', ActivoTipoController::class);

        Route::get('activos/import', [ActivoController::class,'importar'])->name('activos.importar');
        Route::post('activos/import', [ActivoController::class,'importarStore'])->name('activos.importar.store');

        Route::resource('activos', ActivoController::class);

        Route::resource('activoTarjetas', ActivoTarjetaController::class);
        Route::any('/activoTajeta/pdf/{activoTarjeta}', [ActivoTarjetaController::class,'pdf'])->name('activoTarjetas.pdf');


        Route::resource('activoTarjetaDetalles', ActivoTarjetaDetalleController::class);


        Route::resource('activoSolicitudTipos', ActivoSolicitudTipoController::class);


        Route::resource('activoSolicitudEstados', ActivoSolicitudEstadoController::class);


        Route::resource('activoSolicitudes', ActivoSolicitudController::class);
        Route::post('activoSolicitudes/anular/{activoSolicitud}', [ActivoSolicitudController::class,'anular'])->name('activoSolicitudes.anular');


        Route::resource('activoSolicitudDetalles', ActivoSolicitudDetalleController::class);

    });

    Route::get('inventario/1h', function () { return View::make('partials.en_construccion'); })->name('inventario.1h');

    Route::get('solicitud/cargo/descargo/bienes', function () { return View::make('partials.en_construccion'); })->name('solicitud.cargo.descargo.bienes');

    Route::get('reporte/bienes/unidad', function () { return View::make('partials.en_construccion'); })->name('reporte.bienes.unidad');

    Route::resource('activoTarjetaEstados', App\Http\Controllers\ActivoTarjetaEstadoController::class);


    Route::resource('bodegas', App\Http\Controllers\BodegaController::class);



    Route::resource('consumoEstados', App\Http\Controllers\ConsumoEstadoController::class);


    Route::get('mis/consumos', [ConsumoController::class,'user'])->name('consumos.usuario');
    Route::get('consumos/cancelar/{consumo}', [ConsumoController::class,'cancelar'])->name('consumos.cancelar');
    Route::post('consumos/anular/{consumo}', [ConsumoController::class,'anular'])->name('consumos.anular');
    Route::resource('consumos', ConsumoController::class);

});





/**
 * Rutas web
 */
Route::group(['prefix' => ''], function () {


    Route::get('/', [HomeAdminController::class,'index'])->name('index');
    Route::get('home', [HomeAdminController::class,'index'])->name('home');
//    Route::get('/', [HomeController::class,'index'])->name('index');
//    Route::get('home', [HomeController::class,'index'])->name('home');



});


