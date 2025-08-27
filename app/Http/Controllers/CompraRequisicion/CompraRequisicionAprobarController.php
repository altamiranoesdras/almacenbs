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

        $bandeja = CompraBandeja::find(CompraBandeja::APROBADOR_DE_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.aprobar.index',compact('bandeja'));

    }
}
