<?php

namespace App\Http\Controllers;

use App\DataTables\SolicitudApruebaDataTable;
use App\Models\Solicitud;
use App\Models\SolicitudEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudApruebaController extends Controller
{
    public function __construct()
    {

    }

    public function index(SolicitudApruebaDataTable $solicitudeDataTable)
    {
        return $solicitudeDataTable->render('solicitudes.aprobar.index');
    }


    public function store(Solicitud $solicitud)
    {


        try {
            DB::beginTransaction();

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
}
