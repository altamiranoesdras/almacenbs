<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudApruebaDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
use App\Models\User;
use App\Notifications\RequisicionAprobacionDespachoNotificacion;
use App\Notifications\RequisicionAprobacionSolicitanteNotificacion;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudApruebaController extends Controller
{
    public function __construct()
    {

    }

    public function index(SolicitudApruebaDataTable $solicitudeDataTable)
    {
        $scope = new ScopeSolicitudDataTable();
        $scope->estados = [SolicitudEstado::SOLICITADA,SolicitudEstado::AUTORIZADA];
        $solicitudeDataTable->addScope($scope);

        return $solicitudeDataTable->render('solicitudes.aprobar.index');
    }


    public function store(Solicitud $solicitud,Request $request)
    {



        try {
            DB::beginTransaction();


            if ($request->retornar){

                $this->retornar($solicitud,$request);
                $msj="Solicitud retornada correctamente";

            }else{

                $this->aprueba($solicitud,$request);
                $msj="Solicitud aprobada correctamente";

            }


        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);

            return redirect(route('solicitudes.despachar'));
        }


        DB::commit();

        flash($msj)->success()->important();

        return redirect(route('solicitudes.aprobar'));
    }

    public function enviarNotificacionDespechador()
    {

        $usuarios = User::all()->filter(function (User $user) {
            return $user->can('Despachar Requisición') && $user->id > 3;
        });

        foreach ($usuarios as $usuario) {
            $usuario->notify(new RequisicionAprobacionDespachoNotificacion());
        }

    }

    public function aprueba(Solicitud $solicitud,Request $request)
    {


        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($solicitud->detalles as $index => $detalle) {
            $detalle->cantidad_aprobada = $request->cantidades_aprueba[$index];
            $detalle->save();
        }

        $solicitud->estado_id = SolicitudEstado::APROBADA;
        $solicitud->usuario_aprueba = auth()->user()->id;
        $solicitud->fecha_aprueba = Carbon::now();
        $solicitud->save();



        try {

//                $this->enviarNotificacionDespechador();
//                $solicitud->usuarioSolicita->notify(new RequisicionInformaAprobacionNotificacion());

            event(new EventoCambioEstadoSolicitud($solicitud));
        }catch (Exception $exception){

        }
//            Mail::send(new DespacharSolicitud($solicitud));

        $solicitud->addBitacora("SISTEMA","REQUISICIÓN APROBADA",'');
    }


    public function retornar(Solicitud $solicitud,Request $request)
    {

        $solicitud->estado_id = SolicitudEstado::RETORNO_SOLICITADA;
        $solicitud->usuario_aprueba = null;
        $solicitud->fecha_aprueba = null;
        $solicitud->save();

        try {

//            Mail::send(new DespacharSolicitud($solicitud));

        }catch (Exception $exception){

        }

        $solicitud->addBitacora("SISTEMA","REQUISICIÓN RETORNADA","Motivo: ".$request->motivo);
    }

}
