<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class BusinessProfileController extends Controller
{


    //
    /**
     * BusinessProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $meta_keywords = [];

        if (config('app.meta_keywords')){

            foreach (explode(",",config('app.meta_keywords')) as $index => $value) {
                $meta_keywords[$value] = $value ?? '';
            }
        }



        return view('admin.business_profile.index', compact('meta_keywords'));
    }

    public function store(Request $request)
    {


//        dump($request->all());

        foreach ($request->all() as $key => $value) {


            $key = $this->filtrarKey($key);

            if($key && $value){

                if ($key=='meta_keywords'){
                    $value = implode(',', $value);
                }

                Configuration::updateOrCreate([
                    'key' => $key,
                ],[
                    'key' => $key,
                    'value' => $value,
                    'descripcion' => $key,
                ]);
            }
        }



        if ($request->hasFile('logo')){
            /**
             * @var Configuration $config
             */
            $config = Configuration::find(Configuration::LOGO);
            $config->clearMediaCollection('logo');
            $config->addMediaFromRequest('logo')->toMediaCollection('logo');
        }


        if ($request->hasFile('fondo_login')){
            /**
             * @var Configuration $config
             */
            $config = Configuration::find(Configuration::FONDO_LOGIN);
            $config->clearMediaCollection('fondo_login');
            $config->addMediaFromRequest('fondo_login')->toMediaCollection('fondo_login');
        }

        if ($request->hasFile('icono')){
            /**
             * @var Configuration $config
             */
            $config = Configuration::find(Configuration::ICONO);
            $config->clearMediaCollection('icono');
            $config->addMediaFromRequest('icono')
                ->toMediaCollection('icono');


        }

        if ($request->hasFile('promo_factura')){
            /**
             * @var Configuration $config
             */
            $config = Configuration::find(Configuration::LOGO);
            $config->clearMediaCollection('promo_factura');
            $config->addMediaFromRequest('promo_factura')
                ->toMediaCollection('promo_factura');


        }

        if ($request->clear_logo){
            $config = Configuration::find(Configuration::LOGO);
            $config->clearMediaCollection('logo');
        }

        if ($request->clear_icono){
            $config = Configuration::find(Configuration::ICONO);
            $config->clearMediaCollection('icono');
        }

        if ($request->clear_fondo_login){

            $config = Configuration::find(Configuration::FONDO_LOGIN);
            $config->clearMediaCollection('fondo_login');
        }

        if ($request->clear_promo_factura){
            $config = Configuration::find(Configuration::LOGO);
            $config->clearMediaCollection('promo_factura');
        }


//        generarManifest();


        flash('Listo guardado!')->success();

        return redirect(route('profile.business'));
    }




    public function filtrarKey($key)
    {

        if ($key=="_token" || !str_contains($key,'app_')){
            return false;
        }


        //si nicia con app_
        if (strpos($key,'app_')==0){


            $key = substr_replace($key,"app.",0,4);

        }else{

            $key = str_replace("api_cloud_whatsapp_","api_cloud_whatsapp.",$key);

        }


        return $key;
    }

}
