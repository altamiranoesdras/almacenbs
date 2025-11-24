<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAnalistaCompraDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompraRequisicionAnalistaCompraRequest;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicionEstado;
use DB;

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

    public function procesar(CompraRequisicion $requisicion, CompraRequisicionAnalistaCompraRequest $request)
    {
        if ($requisicion->estado_id == CompraRequisicionEstado::INICIO_DE_GESTION) {
            $request->validate([
                'numero_orden_compra'       => 'required|string',
                'orden_compra'              => 'required|file',
            ]);

        }

        try {
            DB::beginTransaction();

            $requisicion->analistaComprasProcesar($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('compra.requisiciones.analista.compras')->with('success', 'La requisición ha sido procesada correctamente.');
    }

}
