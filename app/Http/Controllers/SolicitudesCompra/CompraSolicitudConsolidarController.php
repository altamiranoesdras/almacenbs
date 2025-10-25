<?php

namespace App\Http\Controllers\SolicitudesCompra;

use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\DataTables\SolicitudesCompra\SolicitudCompraUnificarTable;
use App\Http\Controllers\Controller;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicionDetalle;
use App\Models\CompraRequisicionEstado;
use App\Models\CompraSolicitud;
use App\Models\CompraSolicitudEstado;
use App\Models\User;
use Illuminate\Http\Request;

class CompraSolicitudConsolidarController extends Controller
{
    public function index(SolicitudCompraUnificarTable $dataTable)
    {
        /**
         * @var User $usuarioActual
         */
        $usuarioActual = auth()->user();

        $scope = new ScopeCompraSolicitudDataTable(
            estados: CompraSolicitudEstado::SOLICITADA,
        );

        $dataTable->addScope($scope);

        return $dataTable->render('compra_solicitudes.consolidar.index');

    }

    /**
     * Consolidar solicitudes de compra.
     *
     * @param  Request  $request

     */
    public function consolidarSolicitudes(Request $request)
    {
        $request->validate([
            'solicitudes_ids' => 'required|array|min:1',
        ]);

        $solicitudIds = $request->input('solicitudes_ids');

        try {
            /**
             * @var CompraRequisicion $requisicion
             */
            $requisicion = CompraRequisicion::create([
                'estado_id' => CompraRequisicionEstado::CREADA,
                'usuario_crea_id' => auth()->id(),
                'unidad_id' => auth()->user()->unidad_id,
            ]);

            $solicitudes = CompraSolicitud::with('detalles')
                ->whereIn('id', $solicitudIds)
                ->get();

            $detallesRequisicion = collect();

            foreach ($solicitudes as $solicitud) {

                $requisicion->compraSolicitudes()->attach($solicitud->id);

                foreach ($solicitud->detalles as $detalle) {
                    $detallesRequisicion->push( new CompraRequisicionDetalle(
                        [
                            'item_id' => $detalle->item_id,
                            'cantidad' => $detalle->cantidad,
                            'precio_estimado' => $detalle->precio_estimado,
                            'solicitud_detalle_id' => $detalle->id,
                        ]
                    ));
                }
            }

            $requisicion->detalles()->saveMany($detallesRequisicion);


        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'Error al consolidar las solicitudes: ' . $e->getMessage()]);
        }



        return redirect()->route('compra.requisiciones.edit', $requisicion->id)
            ->with('success', 'Solicitudes consolidadas en la requisición exitosamente.');

    }


    public function validaSolicitudes(Request $request)
    {
        $solicitudIds = $request->input('solicitudes_ids');

        $solicitudes = CompraSolicitud::with('detalles')
            ->whereIn('id', $solicitudIds)
            ->get();

        $padres = null;
        foreach ($solicitudes as $solicitud) {
            $padres[$solicitud->id] = $solicitud->unidad->direccionPadre()->id ?? null;
        }

        dd($padres);

        return $solicitudes;

    }
}
