<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PassportClientsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('login/{driver}', [LoginController::class,'redirectToProvider'])->name('social_auth');
Route::get('login/{driver}/callback', [LoginController::class,'handleProviderCallback']);



/**
 * Rutas admin
 */
Route::group(['prefix' => 'admin','middleware' => ['role:Admin|Superadmin|Developer','auth']], function () {


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




    Route::resource('compraEstados', App\Http\Controllers\CompraEstadoController::class);


    Route::resource('proveedors', App\Http\Controllers\ProveedorController::class);


    Route::resource('compraTipos', App\Http\Controllers\CompraTipoController::class);


    Route::resource('compras', App\Http\Controllers\CompraController::class);


    Route::resource('itemCategorias', App\Http\Controllers\ItemCategoriaController::class);


    Route::resource('marcas', App\Http\Controllers\MarcaController::class);


    Route::resource('magnituds', App\Http\Controllers\MagnitudController::class);


    Route::resource('unimeds', App\Http\Controllers\UnimedController::class);


    Route::resource('renglons', App\Http\Controllers\RenglonController::class);


    Route::resource('items', App\Http\Controllers\ItemController::class);


    Route::resource('compraDetalles', App\Http\Controllers\CompraDetalleController::class);


    Route::resource('denominacions', App\Http\Controllers\DenominacionController::class);


    Route::resource('divisas', App\Http\Controllers\DivisaController::class);


    Route::resource('equivalencias', App\Http\Controllers\EquivalenciaController::class);


    Route::resource('stockInicials', App\Http\Controllers\StockInicialController::class);


    Route::resource('itemTrasladoEstados', App\Http\Controllers\ItemTrasladoEstadoController::class);


    Route::resource('itemTraslados', App\Http\Controllers\ItemTrasladoController::class);


    Route::resource('kardexes', App\Http\Controllers\KardexController::class);


    Route::resource('solicitudEstados', App\Http\Controllers\SolicitudEstadoController::class);


    Route::resource('rrhhUnidads', App\Http\Controllers\RrhhUnidadController::class);


    Route::resource('solicituds', App\Http\Controllers\SolicitudController::class);


    Route::resource('solicitudDetalles', App\Http\Controllers\SolicitudDetalleController::class);


    Route::resource('stocks', App\Http\Controllers\StockController::class);


    Route::resource('stockTransaccions', App\Http\Controllers\StockTransaccionController::class);


    Route::resource('userDespachaUsers', App\Http\Controllers\UserDespachaUserController::class);


    Route::resource('envioFiscals', App\Http\Controllers\EnvioFiscalController::class);


    Route::resource('compra1hs', App\Http\Controllers\Compra1hController::class);


    Route::resource('compra1hDetalles', App\Http\Controllers\Compra1hDetalleController::class);


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

