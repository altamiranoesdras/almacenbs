<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAnalistaCompraDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Http\Request;

class CompraRequisicionAnalistaCompraController extends Controller
{
    public function index(CompraRequisicionAnalistaCompraDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::ANALISTA_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;
        $scope->usuario_analista_id = usuarioAutenticado()->id;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.analista_compras.index', compact('bandeja'));

    }
    public function seguimiento(CompraRequisicion $requisicion)
    {

        return view('compra_requisiciones.analista_compras.seguimiento', compact('requisicion'));
    }

    public function procesar(CompraRequisicion $requisicion, Request $request)
    {
        $request->validate([
            'tipo_proceso_id' => 'required|integer',
            'numero_npg' => 'nullable|string',
            'numero_nog' => 'nullable|string',
            'concurso_id' => 'required|integer',
            'proveedor_id' => 'required|integer',
            'numero_adjudicacion' => 'required|string',
        ]);

        $requisicion->analistaComprasProcesar($request);

        return redirect()->route('compra.requisiciones.analista.compras')->with('success', 'La requisición ha sido procesada correctamente.');
    }

}
