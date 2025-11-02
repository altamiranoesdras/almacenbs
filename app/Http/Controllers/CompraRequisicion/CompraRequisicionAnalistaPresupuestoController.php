<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAnalistaPresupuestoDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Http\Request;

class CompraRequisicionAnalistaPresupuestoController extends Controller
{
    public function index(CompraRequisicionAnalistaPresupuestoDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::ANALISTA_PRESUPUESTO);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.analista_presupuesto.index', compact('bandeja'));

    }

    public function seguimiento(CompraRequisicion $requisicion)
    {
        return view('compra_requisiciones.analista_presupuesto.seguimiento', compact('requisicion'));
    }

    public function procesar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->analistaPresupuestoVistoBueno($request->comentario);

        return redirect()
            ->route('compra.requisiciones.analista.presupuesto')
            ->with('success', 'La requisición ha sido procesada con éxito.');

    }

    public function retornar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->analistaPresupuestoRetorna($request->comentario ?? null);

        return redirect()
            ->route('compra.requisiciones.analista.presupuesto')
            ->with('success', 'La requisición ha sido retornada con éxito.');

    }
}
