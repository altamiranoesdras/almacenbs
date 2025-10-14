<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudAutorizaDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
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
        $scope->estados = [
            SolicitudEstado::SOLICITADA,
            SolicitudEstado::RETORNO_POR_DESPACHO,
        ];

//        $scope->unidades = auth()->user()->unidad_id;

        $solicitudeDataTable->addScope($scope);

        return $solicitudeDataTable->render('solicitudes.autorizar.index');
    }


    public function store(Solicitud $solicitud,Request $request)
    {


        try {
            DB::beginTransaction();

            if ($request->retornar){

                $solicitud->retornoPorAutorizador($request->motivo ?? '');
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

        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($solicitud->detalles as $index => $detalle) {
            $detalle->cantidad_autorizada = $request->cantidades_autoriza[$index];
            $detalle->save();
        }

        $solicitud->estado_id = SolicitudEstado::AUTORIZADA;
        $solicitud->usuario_autoriza = auth()->user()->id;
        $solicitud->fecha_autoriza = Carbon::now();
        $solicitud->save();

        $solicitud->addBitacora("Requisición autorizada ",'');
    }



}
