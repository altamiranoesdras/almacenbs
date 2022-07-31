<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\Compra1hController;
use App\Http\Controllers\Compra1hDetalleController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompraDetalleController;
use App\Http\Controllers\CompraEstadoController;
use App\Http\Controllers\CompraTipoController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DenominacionController;
use App\Http\Controllers\DivisaController;
use App\Http\Controllers\EnvioFiscalController;
use App\Http\Controllers\EquivalenciaController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCategoriaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemTrasladoController;
use App\Http\Controllers\ItemTrasladoEstadoController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\MagnitudController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PassportClientsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\RenglonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RrhhUnidadController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudDetalleController;
use App\Http\Controllers\SolicitudEstadoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockInicialController;
use App\Http\Controllers\StockTransaccionController;
use App\Http\Controllers\UnimedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDespachaUserController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('compras', CompraController::class);


    Route::resource('itemCategorias', ItemCategoriaController::class);


    Route::resource('marcas', MarcaController::class);


    Route::resource('magnituds', MagnitudController::class);


    Route::resource('unimeds', UnimedController::class);


    Route::resource('renglons', RenglonController::class);


    Route::resource('items', ItemController::class);


    Route::resource('compraDetalles', CompraDetalleController::class);


    Route::resource('denominacions', DenominacionController::class);


    Route::resource('divisas', DivisaController::class);


    Route::resource('equivalencias', EquivalenciaController::class);


    Route::resource('stockInicials', StockInicialController::class);


    Route::resource('itemTrasladoEstados', ItemTrasladoEstadoController::class);


    Route::resource('itemTraslados', ItemTrasladoController::class);


    Route::resource('kardexes', KardexController::class);


    Route::resource('solicitudEstados', SolicitudEstadoController::class);


    Route::resource('rrhhUnidades', RrhhUnidadController::class);


    Route::resource('solicituds', SolicitudController::class);


    Route::resource('userDespachaUsers', UserDespachaUserController::class);


    Route::resource('envioFiscals', EnvioFiscalController::class);


    Route::resource('compra1hs', Compra1hController::class);




});





/**
 * Rutas web
 */
Route::group(['prefix' => ''], function () {


    Route::get('/', [HomeAdminController::class,'index'])->name('index');
    Route::get('home', [HomeAdminController::class,'index'])->name('home');
//    Route::get('/', [HomeController::class,'index'])->name('index');
//    Route::get('home', [HomeController::class,'index'])->name('home');

    Route::get('about', [HomeController::class,'about'])->name('about');
    Route::get('contact', [HomeController::class,'contact'])->name('contact');
    Route::get('cambio/idioma/{lang}', [HomeController::class,'cambioIdioma'])
        ->where([
            'lang' => 'en|es'
        ])
        ->name('cambio.idioma');


});

