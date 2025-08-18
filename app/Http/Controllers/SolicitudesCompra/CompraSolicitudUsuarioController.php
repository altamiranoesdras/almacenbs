<?php

namespace App\Http\Controllers\SolicitudesCompra;

use App\DataTables\RequisicionCompra\MisRequisicionCompraDataTable;
use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;

class CompraSolicitudUsuarioController extends Controller
{
    public function index(MisRequisicionCompraDataTable $dataTable)
    {
        /**
         * @var User $usuarioActual
         */
        $usuarioActual = auth()->user();

        $scope = new ScopeCompraSolicitudDataTable($usuarioActual->id);

        $dataTable->addScope($scope);

        return $dataTable->render('compra_solicitudes.mis_solicitudes.index');

    }
}
