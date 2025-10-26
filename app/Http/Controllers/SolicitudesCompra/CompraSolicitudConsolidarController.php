<?php

namespace App\Http\Controllers\SolicitudesCompra;

use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\DataTables\SolicitudesCompra\SolicitudCompraUnificarTable;
use App\Http\Controllers\Controller;
use App\Models\CompraRequisicion\CompraRequisicion;
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

            $totalDetalles = collect();

            foreach ($solicitudes as $solicitud) {
                $requisicion->compraSolicitudes()->attach($solicitud->id);
                $solicitud->update([
                    'estado_id' => CompraSolicitudEstado::ASIGNADA_A_REQUISICION,
                ]);
                $totalDetalles = $totalDetalles->merge($solicitud->agruparDetalles());
            }

            $detallesAgrupados = $totalDetalles->groupBy('item_id');

            $detallesConsolidados = $detallesAgrupados->map(function ($grupoDeDetalles) use ($requisicion) {
                $representante = $grupoDeDetalles->first();
                return [
                    'requisicion_id'   => $requisicion->id,
                    'item_id'          => $representante->item_id,
                    'cantidad'         => $grupoDeDetalles->sum('cantidad'),
                    'precio_estimado'  => $representante->precio_estimado,
                    'observaciones'    => $representanteOriginal->observaciones ?? null,
                ];
            })->values();

            $detalleRequisicion = $requisicion->detalles()
                ->createMany($detallesConsolidados->toArray());

            foreach ($detallesAgrupados as $itemId => $detalles) {

                $detalleRequisicion->where('item_id', $itemId)->first()
                    ->solicitudDetalles()
                    ->attach($detalles->pluck('id')->toArray());
            }

        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'Error al consolidar las solicitudes: ' . $e->getMessage()]);
        }

        flash()->success('Solicitudes consolidadas en la requisición exitosamente.');

        return redirect()->route('compra.requisiciones.edit', $requisicion->id);

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
