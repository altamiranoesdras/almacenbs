<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudDespachaDataTable;
use App\Mail\DespacharSolicitud;
use App\Mail\StockCriticoPorSolicitudMail;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
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


    public function store(Solicitud $solicitud,Request $request)
    {


        $errores = $this->validaCantidadAprobadaYStock($solicitud,$request);

        if ($errores->count() > 0){
            return redirect()->back()->withErrors($errores->toArray());
        }


        try {
            DB::beginTransaction();

            /**
             * @var SolicitudDetalle $detalle
             */
            foreach ($solicitud->detalles as $index => $detalle) {
                $detalle->cantidad_despachada = $request->cantidades_despacha[$index] ?? $detalle->cantidad_aprobada;
                $detalle->save();
            }

            $solicitud->estado_id = SolicitudEstado::DESPACHADA;
            $solicitud->usuario_despacha = auth()->user()->id;
            $solicitud->fecha_despacha = fechaHoraActualDb();
            $solicitud->save();


            $solicitud->egreso();

//            $this->verificaStockCritico($solicitud);

//            Mail::send(new DespacharSolicitud($solicitud));


        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);

            return redirect(route('solicitudes.despachar'));
        }


        DB::commit();

        flash('Solicitud despachada correctamente')->success()->important();

        return redirect(route('solicitudes.despachar'));
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
        $itemStockCritico= collect();

        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($solicitud->detalles as $detalle){

            if($detalle->item->stock_total <= $detalle->item->stock_minimo){
                $itemStockCritico->push($detalle->item);
            }
        }

        if ($itemStockCritico->count()>0){
            Mail::send(new StockCriticoPorSolicitudMail($itemStockCritico,$solicitud));
        }
    }

}
