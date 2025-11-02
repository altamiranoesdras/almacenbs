<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAnalistaCompraDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;

class CompraRequisicionAnalistaCompraController extends Controller
{
    public function index(CompraRequisicionAnalistaCompraDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::ANALISTA_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.analista_compras.index', compact('bandeja'));

    }
    public function seguimiento(CompraRequisicion $requisicion)
    {
        return view('pagina_en_construccion');

//        return view('compra_requisiciones.analista_compras.seguimiento', compact('requisicion'));
    }

}
