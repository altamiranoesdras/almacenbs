<?php

namespace App\Http\Controllers;

use App\DataTables\SolicitudeDespachaDataTable;
use App\Mail\DespacharSolicitud;
use App\Mail\StockCriticoPorSolicitudMail;
use App\Models\Kardex;
use App\Models\Solicitud;
use App\Models\SolicitudEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudAlmacenController extends Controller
{
    public function despachar(SolicitudeDespachaDataTable $solicitudeDataTable)
    {
        return $solicitudeDataTable->render('solicitudes.almacen.index');
    }


    public function despacharStore(Solicitud $solicitud)
    {


        try {
            DB::beginTransaction();


            $this->procesaStock($solicitud);

            $solicitud->estado_id = SolicitudEstado::DESPACHADA;
            $solicitud->user_despacha = auth()->user()->id;
            $solicitud->tienda_despacha = session('tienda');
            $solicitud->fecha_despacha = fechaHoraActualDb();
            $solicitud->save();

            $this->verificaStock($solicitud);

            Mail::send(new DespacharSolicitud($solicitud));


        } catch (Exception $exception) {
            DB::rollBack();

            if (auth()->user()->isDev()){
                throw new Exception($exception);
            }

            flash('Error al procesar intente de nuevo!')->error()->important();

            return redirect(route('solicitudes.despachar'));
        }


        DB::commit();

        flash('Solicitud despachada correctamanete')->success()->important();

        return redirect(route('solicitudes.despachar'));
    }

    public function procesaStock(Solicitud $solicitud)
    {
        $tiendaSolicita = $solicitud->tiendaSolicita;

        $stock = new Stock();
        foreach ($solicitud->detalles as $detalle){
            $stock = $stock->egresoSolicitud($detalle->item_id,$detalle->cantidad,$detalle->id,$tiendaDespacha->id);

            $detalle->kardex()->create([
                'item_id' => $detalle->item_id,
                'cantidad' => $detalle->cantidad,
                'tipo' => Kardex::TIPO_SALIDA,
                'codigo' => $solicitud->codigo,
                'responsable' => $tiendaSolicita->nombre,
                'user_id' => auth()->user()->id
            ]);
        }

        foreach ($solicitud->detalles as $detalle){
            $stock->ingresoSolicitud($detalle->item_id,$detalle->cantidad,$detalle->id,null,null,$tiendaSolicita->id);

            $detalle->kardex()->create([
                'item_id' => $detalle->item_id,
                'cantidad' => $detalle->cantidad,
                'tipo' => Kardex::TIPO_INGRESO,
                'codigo' => $solicitud->codigo,
                'responsable' => $tiendaDespacha->nombre,
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function verificaStock(Solicitud $solicitud)
    {
        $itemStockCritico= collect();
        foreach ($solicitud->detalles()->with('item')->get() as $detalle){
            if($detalle->item->stockTienda()<=$detalle->item->stockCriticoTienda()){
                $itemStockCritico->push($detalle->item);
            }
        }

        if ($itemStockCritico->count()>0){
            Mail::send(new StockCriticoPorSolicitudMail($itemStockCritico,$solicitud));
        }
    }
}
