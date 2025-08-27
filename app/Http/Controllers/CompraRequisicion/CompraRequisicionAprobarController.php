<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAprobarDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;

class CompraRequisicionAprobarController extends Controller
{
    public function index(CompraRequisicionAprobarDataTable $dataTable)
    {

        $scope = new ScopeCompraRequisicion(bandeja_id: CompraBandeja::APROBADOR_DE_COMPRAS);

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisicions.aprobar.index');

    }
}
