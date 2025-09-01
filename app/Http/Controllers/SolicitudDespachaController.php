<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudDespachaDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Mail\DespacharSolicitud;
use App\Models\Role;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
use App\Models\User;
use App\Notifications\RequisicionSolicitidaNotificacion;
use App\Notifications\StockCriticoNotificacion;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudDespachaController extends Controller
{



    public function __construct()
    {

    }

    public function index(SolicitudDespachaDataTable $solicitudeDataTable)
    {


        $scope = new ScopeSolicitudDataTable();
        $scope->estados = [SolicitudEstado::APROBADA];

        $solicitudeDataTable->addScope($scope);

        return $solicitudeDataTable->render('solicitudes.despachar.index');
    }


    /**
     * @throws \Throwable
     */
    public function store(Solicitud $solicitud, Request $request)
    {



        try {
            DB::beginTransaction();

            if ($request->retornar){

                $this->retornar($solicitud,$request);
                $msj="Solicitud retornada correctamente";

            }else{

                $errores = $this->validaCantidadAprobadaYStock($solicitud,$request);

                if ($errores->count() > 0){
                    return redirect()->back()->withErrors($errores->toArray());
                }

                $solicitud->despachar();

                $this->verificaStockCritico($solicitud);

//            Mail::send(new DespacharSolicitud($solicitud));
                $msj="Solicitud despachada correctamente";

            }


        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash($msj)->error()->important();

            return redirect()->back()->withInput();
        }


        DB::commit();

        flash($msj)->success()->important();

        return redirect(route('solicitudes.despachoPdf',$solicitud->id));
    }




    public function retornar(Solicitud $solicitud,Request $request)
    {

        $solicitud->estado_id = SolicitudEstado::RETORNO_APROBADA;
        $solicitud->usuario_despacha = null;
        $solicitud->fecha_despacha = null;
        $solicitud->save();


        $solicitud->addBitacora("REQUISICIÓN RETORNADA","Motivo: ".$request->motivo);
    }


    /**
     * @param Solicitud $solicitud
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function validaCantidadAprobadaYStock(Solicitud $solicitud,Request $request)
    {

        $errores = collect();

        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($solicitud->detalles as $index => $detalle) {

            $cantidad = $request->cantidades_despacha[$index] ?? $detalle->cantidad_aprobada;


            if ($cantidad > $detalle->item->stock_total){

                $errores->push("No tiene stock suficiente par el insumo: ".$detalle->item->text);

            }else{

                if ($cantidad > $detalle->cantidad_aprobada){
                    $errores->push("No puede despachar mas de la cantidad aprobada par el insumo: ".$detalle->item->text);
                }
            }



        }

        return $errores;
    }

    public function verificaStockCritico(Solicitud $solicitud)
    {
        $itemsStockCritico= collect();

        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($solicitud->detalles as $detalle){

            if($detalle->item->stock_bodega <= $detalle->item->stock_minimo){
                $itemsStockCritico->push($detalle->item);
            }
        }


        if ($itemsStockCritico->count() > 0){

            $usuarios = User::role(Role::JEFE_ALMACEN)->get();


            foreach ($usuarios as $usuario) {
                $usuario->notify(new StockCriticoNotificacion($itemsStockCritico));
            }
        }
    }


}
