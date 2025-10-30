<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionSupervisorDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;

class CompraRequisicionSupervisorController extends Controller
{
    public function index(CompraRequisicionSupervisorDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::SUPERVISOR_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.supervidor.index', compact('bandeja'));

    }
}
