<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudAutorizaDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Models\Solicitud;
use App\Models\SolicitudEstado;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudAutorizaController extends Controller
{
    public function __construct()
    {

    }

    public function index(SolicitudAutorizaDataTable $solicitudeDataTable)
    {
        $scope = new ScopeSolicitudDataTable();
        $scope->estados = SolicitudEstado::SOLICITADA;
        $scope->unidades = auth()->user()->unidad_id;

        $solicitudeDataTable->addScope($scope);

        return $solicitudeDataTable->render('solicitudes.autorizar.index');
    }


    public function store(Solicitud $solicitud,Request $request)
    {


        try {
            DB::beginTransaction();

            if ($request->retornar){

                $this->retornar($solicitud,$request);
                $msj="Solicitud retornada correctamente";

            }else{

                $this->autorizar($solicitud,$request);
                $msj="Solicitud autorizada correctamente";

            }


        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);

            return redirect()->back();
        }


        DB::commit();

        flash($msj)->success()->important();

        return redirect(route('solicitudes.autorizar'));
    }

    public function autorizar(Solicitud $solicitud,Request $request)
    {


        $solicitud->estado_id = SolicitudEstado::AUTORIZADA;
        $solicitud->usuario_autoriza = auth()->user()->id;
        $solicitud->fecha_autoriza = Carbon::now();
        $solicitud->save();

        try {

            event(new EventoCambioEstadoSolicitud($solicitud));
        }catch (Exception $exception){

        }
//            Mail::send(new DespacharSolicitud($solicitud));

        $solicitud->addBitacora("REQUISICIÓN APROBADA",null);
    }


    public function retornar(Solicitud $solicitud,Request $request)
    {

        $solicitud->estado_id = SolicitudEstado::INGRESADA;
        $solicitud->usuario_autoriza = null;
        $solicitud->fecha_autoriza = null;
        $solicitud->save();

        try {

//            Mail::send(new DespacharSolicitud($solicitud));

        }catch (Exception $exception){

        }

        $solicitud->addBitacora("REQUISICIÓN RETORNADA",$request->observacion);
    }
}
