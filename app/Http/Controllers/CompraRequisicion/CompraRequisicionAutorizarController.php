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

        $scope = new ScopeCompraRequisicion(bandeja_id: CompraBandeja::AUTORIZADOR_DE_COMPRAS);

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisicions.aprobar.index');

    }
}
