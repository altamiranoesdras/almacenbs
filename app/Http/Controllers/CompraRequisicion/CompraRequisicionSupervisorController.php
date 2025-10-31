<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionSupervisorDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Http\Request;

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

    public function seguimiento(CompraRequisicion $requisicion)
    {
        return view('compra_requisiciones.supervidor.seguimiento', compact('requisicion'));
    }

    public function procesar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->vistoBuenoSupervisor($request->comentario ?? null);

        return redirect()
            ->route('compra.requisiciones.supervisor')
            ->with('success', 'La requisición ha sido procesada con éxito.');

    }
}
