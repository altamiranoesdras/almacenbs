<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAutorizarDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;

class CompraRequisicionAutorizarController extends Controller
{
    public function index(CompraRequisicionAutorizarDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::APROBADOR_DE_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.autorizar.index');

    }
}
