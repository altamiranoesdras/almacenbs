<?php

namespace App\Http\Controllers\SolicitudesCompra;

use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\DataTables\SolicitudesCompra\SolicitudCompraUnificarTable;
use App\Http\Controllers\Controller;
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
            unidad_id: $usuarioActual->unidad_id,
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

        dd($solicitudIds);


        return redirect()->route('compra.solicitudes.consolidar');

    }
}
