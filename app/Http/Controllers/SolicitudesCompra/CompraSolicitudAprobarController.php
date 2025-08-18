<?php

namespace App\Http\Controllers\SolicitudesCompra;

use App\DataTables\RequisicionCompra\AprobarRequisicionCompraDataTable;
use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\Http\Controllers\Controller;
use App\Models\CompraSolicitudEstado;
use App\Models\User;

class CompraSolicitudAprobarController extends Controller
{
    public function index(AprobarRequisicionCompraDataTable $dataTable)
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

        return $dataTable->render('compra_solicitudes.aprobar.index');

    }
}
