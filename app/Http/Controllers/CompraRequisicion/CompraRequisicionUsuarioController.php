<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionUsuarioDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;

class CompraRequisicionUsuarioController extends Controller
{
    public function index(CompraRequisicionUsuarioDataTable $dataTable)
    {

        $usuarioActual = auth()->user();

        $scope = new ScopeCompraRequisicion($usuarioActual->id);

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisicions.mis_requisiciones.index');

    }
}
