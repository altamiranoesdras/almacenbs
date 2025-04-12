<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PruebaNotificacion;
use Illuminate\Http\Request;

class PruebasController extends Controller
{
    /**
     * PruebasController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('developer.pruebas');
    }


    public function enviarNotificacion(Request $request)
    {



        /**
         * @var User $user
         */
        $user = auth()->user();

        if ($request->correo){

            $request->validate([
                'correo' => 'email'
            ]);
            $user = new User();

            $user->email = $request->correo;
        }


        try {

            $user->notify(new PruebaNotificacion());

        }catch (\Exception $exception){

            flash()->error("Erro al enviar notificación!");
            return redirect()->back();
        }

        flash()->success("Notificación enviada!");

        return redirect()->back();
    }


    public function vistaPreviaCorreo()
    {

        return (new PruebaNotificacion())
            ->toMail('ejemplo@dominio.com');

    }
}
