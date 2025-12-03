<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionSupervisorDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

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

    /**
     * @throws Throwable
     */
    public function procesar(CompraRequisicion $requisicion, Request $request)
    {

        if($requisicion->puedeAsignarAnalistaCompras() && !$request->usuario_analista_id){
            return redirect()
                ->back()
                ->withErrors(['error' => 'Debe seleccionar un analista de compras para continuar.'])
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $requisicion->supervisorAsignaAnalista($request->usuario_analista_id, $request->observaciones);

        } catch (Throwable $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash($msj)->error();

            return redirect()
                ->route('compra.requisiciones.supervisor')
                ->withErrors(['error' => $msj])
                ->withInput();
        }

        DB::commit();

        flash('Requisición enviada a Analista de compras.')->success();

        return redirect()->route('compra.requisiciones.supervisor');
    }

    public function retornar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->supervisorRetornar($request->comentario ?? null);

        return redirect()
            ->route('compra.requisiciones.supervisor')
            ->with('success', 'La requisición ha sido retornada con éxito.');

    }
}
