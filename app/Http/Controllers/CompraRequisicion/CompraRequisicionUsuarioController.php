<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionUsuarioDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;

class CompraRequisicionUsuarioController extends Controller
{
    public function index(CompraRequisicionUsuarioDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::SOLICITANTE_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->usuario_crea = auth()->id();

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.mis_requisiciones.index',compact('bandeja'));

    }
}
