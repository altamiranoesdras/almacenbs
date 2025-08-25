<?php

namespace App\Http\Controllers\SolicitudesCompra;

use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\DataTables\SolicitudesCompra\SolicitudCompraUnificarTable;
use App\Http\Controllers\Controller;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicion\CompraRequisicionEstado;
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
            ]);

            $detallesSolicitud = collect();

            foreach ($solicitudIds as $id) {
                /** @var CompraSolicitud $solicitud */
                $solicitud = CompraSolicitud::findOrFail($id);

                $solicitud->update([
                    'estado_id' => CompraSolicitudEstado::ASIGNADA_A_REQUISICION,
                ]);

                $solicitud->loadMissing('detalles');

                $detallesSolicitud = $detallesSolicitud->merge($solicitud->detalles);
            }

            foreach ($detallesSolicitud as $detalle) {
                $requisicion->detalles()->create([
                    'solicitud_detalle_id' => $detalle->id,
                    'item_id' => $detalle->item_id,
                    'cantidad' => $detalle->cantidad,
                    'precio_estimado' => $detalle->precio_estimado,
                ]);
            }

            $requisicion->compraSolicitudes()
                ->sync($solicitudIds);

        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'Error al consolidar las solicitudes: ' . $e->getMessage()]);
        }



        return redirect()->route('admin.mantenimiento-pagina');

    }
}
