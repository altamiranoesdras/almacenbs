<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudApruebaDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
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

        dd($request->all());



        try {
            DB::beginTransaction();


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
                event(new EventoCambioEstadoSolicitud($solicitud));
            }catch (Exception $exception){

            }
//            Mail::send(new DespacharSolicitud($solicitud));


        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);

            return redirect(route('solicitudes.despachar'));
        }


        DB::commit();

        flash('Solicitud aprobada correctamente')->success()->important();

        return redirect(route('solicitudes.aprobar'));
    }
}
