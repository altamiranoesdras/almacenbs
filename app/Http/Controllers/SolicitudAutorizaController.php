<?php

namespace App\Http\Controllers;

use App\DataTables\SolicitudAutorizaDataTable;
use App\Models\Solicitud;
use App\Models\SolicitudEstado;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SolicitudAutorizaController extends Controller
{
    public function __construct()
    {

    }

    public function index(SolicitudAutorizaDataTable $solicitudeDataTable)
    {
        return $solicitudeDataTable->render('solicitudes.autorizar.index');
    }


    public function store(Solicitud $solicitud)
    {


        try {
            DB::beginTransaction();

            $solicitud->estado_id = SolicitudEstado::DESPACHADA;
            $solicitud->usuario_autoriza = auth()->user()->id;
            $solicitud->fecha_autoriza = Carbon::now();
            $solicitud->save();


            $solicitud->egreso();

//            $this->verificaStockCritico($solicitud);

//            Mail::send(new DespacharSolicitud($solicitud));


        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);

            return redirect()->back();
        }


        DB::commit();

        flash('Solicitud autorizada correctamente')->success()->important();

        return redirect(route('solicitudes.autorizar'));
    }
}
