<?php

use App\Http\Controllers\ActivoController;
use App\Http\Controllers\ActivoEstadoController;
use App\Http\Controllers\ActivoSolicitudController;
use App\Http\Controllers\ActivoSolicitudDetalleController;
use App\Http\Controllers\ActivoSolicitudEstadoController;
use App\Http\Controllers\ActivoSolicitudTipoController;
use App\Http\Controllers\ActivoTarjetaController;
use App\Http\Controllers\ActivoTarjetaDetalleController;
use App\Http\Controllers\ActivoTipoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\Compra1hController;
use App\Http\Controllers\CompraDetalleController;
use App\Http\Controllers\CompraEstadoController;
use App\Http\Controllers\CompraTipoController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DenominacionController;
use App\Http\Controllers\DivisaController;
use App\Http\Controllers\EnvioFiscalController;
use App\Http\Controllers\EquivalenciaController;
use App\Http\Controllers\FirmaElectronicaController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\ItemCategoriaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemTipoController;
use App\Http\Controllers\ItemTrasladoController;
use App\Http\Controllers\ItemTrasladoEstadoController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LibroAlamcenController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MagnitudController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PassportClientsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\RenglonController;
use App\Http\Controllers\ReportesAlmacenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RrhhPuestoController;
use App\Http\Controllers\RrhhUnidadController;
use App\Http\Controllers\SolicitudApruebaController;
use App\Http\Controllers\SolicitudAutorizaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudDespachaController;
use App\Http\Controllers\SolicitudEstadoController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UnimedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDespachaUserController;
use App\Models\User;
use App\Notifications\NoticiaPrueba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('login/{driver}', [LoginController::class,'redirectToProvider'])->name('social_auth');
Route::get('login/{driver}/callback', [LoginController::class,'handleProviderCallback']);


/**
 * Rutas admin protegidas
 */
Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {


    Route::group(['as' => 'admin.'],function (){

        Route::get('/', [HomeAdminController::class,'index'])->name('index');
        Route::get('/home', [HomeAdminController::class,'index'])->name('home');
        Route::get('/dashboard', [HomeAdminController::class,'dashboard'])->name('dashboard');
        Route::get('/calendar', [HomeAdminController::class,'calendar'])->name('calendar');

        Route::get('/pagina/mantenimiento', [HomeAdminController::class,'paginaMantenimiento'])->name('mantenimiento-pagina');

    });

    Route::group(['prefix' => 'dev','as' => 'dev.'],function (){

        Route::get('logs', [LogController::class,'index'])->name('logs');

        Route::group(['prefix' => 'pruebas','as' => 'pruebas.'],function (){

            Route::get('/',[PruebasController::class,'index'])->name('index');
            Route::post('enviar/notificacion',[PruebasController::class,'enviarNotificacion'])->name('enviar.notificacion');
            Route::get('correo/vista/previa',[PruebasController::class,'vistaPreviaCorreo'])->name('correo.vista.previa');
            Route::get('api',[PruebaApiController::class,'index'])->name('api');
            Route::get('error/{codigo}',function ($codigo){
                return abort($codigo);
            })->name('error');
        });

        Route::get('prueba/mail',function (){

            $items = \App\Models\Item::limit(5)->get();

            return (new \App\Notifications\StockCriticoNotificacion($items))
                ->toMail('ejemplo@dominio.com');
        });

        Route::get('prueba/api',[PruebaApiController::class,'index'])->name('prueba.api');

        Route::get('passport/clients', [PassportClientsController::class,'index'])->name('passport.clients');

        Route::resource('configurations', ConfigurationController::class);
        Route::post('configurations/prueba/correo',[ConfigurationController::class,'pruebaCorreo'])->name('configurations.prueba.correo');

        Route::get('logs', [LogController::class,'index'])->name('logs');


        Route::get('option/create/{option?}', [OptionController::class,'create'])->name('option.create');
        Route::get('option/orden', [OptionController::class,'updateOrden'])->name('option.order.store');
        Route::resource('options',OptionController::class);
    });



    Route::get('profile/business', [BusinessProfileController::class,'index'])->name('profile.business');
    Route::post('profile/business', [BusinessProfileController::class,'store'])->name('profile.business.store');

    Route::get('profile', [ProfileController::class,'index'])->name('profile');
    Route::patch('profile/{user}', [ProfileController::class,'update'])->name('profile.update');
    Route::patch('profile/{user}/update/password', [ProfileController::class,'updatePassword'])->name('profile.update.password');
    Route::post('profile/{user}/edit/avatar', [ProfileController::class,'editAvatar'])->name('profile.edit.avatar');
    Route::post('profile/{user}/edit/rubrica', [UserController::class,'guardarRubrica'])->name('profile.edit.rubrica');
    Route::get('profile/{user}/remove/avatar', [ProfileController::class,'removeAvatar'])->name('profile.remove.avatar');


    Route::resource('users', UserController::class);
    Route::get('user/{user}/menu', [UserController::class,'menu'])->name('user.menu');;
    Route::patch('user/menu/{user}', [UserController::class,'menuStore'])->name('users.menuStore');


    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);




    Route::resource('compraEstados', CompraEstadoController::class);


    Route::resource('proveedores', ProveedorController::class);

   Route::resource('compraTipos', CompraTipoController::class);





    Route::resource('itemCategorias', ItemCategoriaController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('magnitudes', MagnitudController::class);
    Route::resource('unimeds', UnimedController::class);
    Route::resource('renglones', RenglonController::class);


    Route::get('items/import', [ItemController::class,'importar'])->name('items.importar');
    Route::post('items/import', [ItemController::class,'importarStore'])->name('items.importar.store');

    Route::get('items/nuevo', [ItemController::class,'create'])->name('items.nuevo');
    Route::resource('items', ItemController::class);


    Route::resource('compraDetalles', CompraDetalleController::class);


    Route::resource('denominaciones', DenominacionController::class);


    Route::resource('divisas', DivisaController::class);


    Route::resource('equivalencias', EquivalenciaController::class);


    Route::resource('itemTrasladoEstados', ItemTrasladoEstadoController::class);


    Route::post('itemTraslados/anular/{itemTraslado}', [ItemTrasladoController::class,'anular'])->name('itemTraslados.anular');
    Route::resource('itemTraslados', ItemTrasladoController::class);




    Route::resource('solicitudEstados', SolicitudEstadoController::class);


    Route::resource('rrhhUnidadTipos', App\Http\Controllers\RrhhUnidadTipoController::class);

    Route::get('rrhhUnidad/create/{unidad?}', [RrhhUnidadController::class,'create'])->name('rrhhUnidad.create');
    Route::resource('rrhhUnidades', RrhhUnidadController::class);

    Route::resource('colaboradores', ColaboradorController::class);

    Route::resource('rrhhContratos', App\Http\Controllers\RrhhContratoController::class);

    Route::resource('contratos', ContratoController::class);



    Route::any('/solicitudes/preimpreso/{solicitud}', [SolicitudController::class,'preimpreso'])->name('solicitudes.preimpreso');

    Route::any('/solicitudes/despachoPdf/{solicitud}', [SolicitudController::class,'despachoPdf'])->name('solicitudes.despachoPdf');
    Route::any('/solicitudes/despachoPdf/digital/{solicitud}', [SolicitudController::class,'despachoPdfDigital'])->name('solicitudes.despachoPdf.digital');

    Route::get('mis/solicitudes', [SolicitudController::class,'user'])->name('solicitudes.usuario');

    Route::get('solicitudes/autorizar', [SolicitudAutorizaController::class,'index'])->name('solicitudes.autorizar');
    Route::post('solicitudes/autorizar/{solicitud}', [SolicitudAutorizaController::class,'store'])->name('solicitudes.autorizar.store');

    Route::get('solicitudes/aprobar', [SolicitudApruebaController::class,'index'])->name('solicitudes.aprobar');
    Route::post('solicitudes/aprobar/{solicitud}', [SolicitudApruebaController::class,'store'])->name('solicitudes.aprobar.store');

    Route::get('solicitudes/despachar', [SolicitudDespachaController::class,'index'])->name('solicitudes.despachar');
    Route::post('solicitudes/despachar/{solicitud}', [SolicitudDespachaController::class,'store'])->name('solicitudes.despachar.store');

    Route::get('solicitudes/cancelar/{solicitud}', [SolicitudController::class,'cancelar'])->name('solicitudes.cancelar');
    Route::post('solicitudes/anular/{solicitud}', [SolicitudController::class,'anular'])->name('solicitudes.anular');

    Route::get('nueva/solicitud/almacen', [SolicitudController::class,'create'])->name('nueva.solicitud.almacen');
    Route::resource('solicitudes', SolicitudController::class);


    Route::resource('userDespachaUsers', UserDespachaUserController::class);


    Route::resource('envioFiscales', EnvioFiscalController::class);


    Route::resource('compra1hs', Compra1hController::class);

    Route::resource('rrhhPuestos', RrhhPuestoController::class);

    Route::resource('itemTipos', ItemTipoController::class);

    Route::resource('itemPresentaciones', App\Http\Controllers\ItemPresentacionController::class);


    Route::get('reportes/kardex/{folio}', [ReportesAlmacenController::class,'kardexPdf'])->name('reportes.kardex.pdf');
    Route::patch('reportes/kardex/ajax/{folio}', [ReportesAlmacenController::class,'actualizaKardexAjax'])->name('reportes.kardex.actualizar.ajax');
    Route::patch('reportes/kardex/{folio}', [ReportesAlmacenController::class,'actualizaKardex'])->name('reportes.kardex.actualizar');
    Route::get('reportes/kardex', [ReportesAlmacenController::class,'kardex'])->name('reportes.kardex');
    Route::get('reportes/kardex-show', [ReportesAlmacenController::class,'kardexShow'])->name('reportes.kardex.show');
    Route::get('reportes/kardex/nuevo/folio/{kardex}', [ReportesAlmacenController::class,'nuevoFolio'])->name('reportes.kardex.nuevo.folio');

    Route::get('reportes/stock', [ReportesAlmacenController::class,'stock'])->name('reportes.stock');
    //actualiara fecha de vencimiento
    Route::patch('reportes/stock', [ReportesAlmacenController::class,'actualizaStock'])->name('reportes.stock.actualizar');


    Route::get('reportes/items/vencen', [ReportesAlmacenController::class,'itemsAvencer'])->name('reportes.items.vencen');


    Route::get('reportes/existencia-insumos', [ReportesAlmacenController::class,'existenciaInsumos'])->name('reportes.existencia.insumos');

    // Nuevas rutas para los 12 reportes
    Route::get('reportes/existencia-por-unidad-solicitante', [ReportesAlmacenController::class,'existenciaPorUnidadSolicitante'])->name('reportes.existencia.unidad.solicitante');
    Route::get('reportes/existencia-por-subsecretaria', [ReportesAlmacenController::class,'existenciaPorSubsecretaria'])->name('reportes.existencia.subsecretaria');
    Route::get('reportes/existencia-periodicas', [ReportesAlmacenController::class,'existenciaPeriodicas'])->name('reportes.existencia.periodicas');
    Route::get('reportes/ingresos-egresos-diarios', [ReportesAlmacenController::class,'ingresosEgresosDiarios'])->name('reportes.ingresos.egresos.diarios');
    Route::get('reportes/1h-elaborados-mensuales', [ReportesAlmacenController::class,'unoHElaboradosMensuales'])->name('reportes.1h.elaborados.mensuales');
    Route::get('reportes/antiguedad-inventario', [ReportesAlmacenController::class,'antiguedadInventario'])->name('reportes.antiguedad.inventario');
    Route::get('reportes/movimiento-por-tipo', [ReportesAlmacenController::class,'movimientoPorTipo'])->name('reportes.movimiento.por.tipo');
    Route::get('reportes/movimientos-compra-por-proveedor', [ReportesAlmacenController::class,'movimientosCompraPorProveedor'])->name('reportes.movimientos.compra.proveedor');
    Route::get('reportes/operaciones-por-empleado', [ReportesAlmacenController::class,'operacionesPorEmpleado'])->name('reportes.operaciones.por.empleado');
    Route::get('reportes/registro-control-inventario', [ReportesAlmacenController::class,'registroControlInventario'])->name('reportes.registro.control.inventario');
    Route::get('reportes/movimiento-salidas-por-unidad', [ReportesAlmacenController::class,'movimientoSalidasPorUnidad'])->name('reportes.movimiento.salidas.unidad');



    Route::get('compras/libro/almacen/pdf', [LibroAlamcenController::class,'pdf'])->name('compras.libro.almacen.pdf');
    Route::get('compras/libro/almacen', [LibroAlamcenController::class,'index'])->name('compras.libro.almacen');

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
    Route::get('consumos/pdf/{consumo}', [ConsumoController::class,'pdf'])->name('consumos.pdf');
    Route::post('consumos/anular/{consumo}', [ConsumoController::class,'anular'])->name('consumos.anular');
    Route::resource('consumos', ConsumoController::class);

    Route::resource('itemModelos', App\Http\Controllers\ItemModeloController::class);



    Route::get('stocks/import', [\App\Http\Controllers\ImportarStockController::class,'index'])->name('stocks.importar');
    Route::post('stocks/import', [\App\Http\Controllers\ImportarStockController::class,'importar'])->name('stocks.importar.procesar');

    Route::get('notificaciones/leer/{notification}', [NotificacionesController::class,'leer'])->name('notificaciones.leer');
    Route::resource('notificaciones', NotificacionesController::class);

    include 'rutas_compras.php';

    include 'rutas_ingreso_almacen.php';

    Route::resource('costo-centros', App\Http\Controllers\CostoCentroController::class);

    Route::group(['prefix' => 'pruebas', 'as' => 'pruebas.',], function () {

        Route::get('firma-electronica', [FirmaElectronicaController::class, 'index'])->name('firma.electronica');
        Route::post('firmar-documento', [FirmaElectronicaController::class, 'firmarDocumento'])->name('firmar.documento');
    });

    Route::resource('envioFiscales', App\Http\Controllers\EnvioFiscalController::class);


    Route::get('/test', [TestController::class, 'test'])->name('test');
    Route::get('/test-reverb', [TestController::class, 'reverb'])->name('reverb');
    Route::post('/test-reverb', [TestController::class, 'testEvent'])->name('test.reverb');


    Route::post('change-layout', [LayoutController::class, 'changeLayout'])->name('change.layout');

    Route::get('enviar-correo', function () {
        $userId = 1;
        $user = User::find($userId);

        // if (!$user) {
        //     $this->error("No se encontró el usuario con ID {$userId}");
        //     return;
        // }

        // $user->notify(new NoticiaPrueba());


        Notification::route('mail', [
            $user->email
        ])->notify(new NoticiaPrueba());


        return "Correo enviado a {$user->email}";
    })->name('enviar.correo');



    Route::group(['prefix' => 'red-produccion','as' =>'red-produccion.'], function () {
        Route::resource('resultados', App\Http\Controllers\RedProduccionResultadoController::class);
    });

    Route::group(['prefix' => 'estructura-presupuestaria','as' =>'estructura-presupuestaria.'], function () {
        Route::resource('programas', App\Http\Controllers\EstructuraPresupuestariaProgramaController::class);
    });

    Route::get('pruebas', function () {
        return view('pruebas');
    })->name('pruebas');

    Route::resource('regiones', App\Http\Controllers\RegionController::class);

    Route::resource('departamentos', App\Http\Controllers\DepartamentoController::class);
    Route::resource('municipios', App\Http\Controllers\MunicipioController::class);
});


/**
 * Rutas web públicas
 */
Route::group(['prefix' => ''], function () {


    Route::get('/', [HomeAdminController::class,'index'])->name('index');
    Route::get('home', [HomeAdminController::class,'index'])->name('home');
//    Route::get('/', [HomeController::class,'index'])->name('index');
//    Route::get('home', [HomeController::class,'index'])->name('home');



});




