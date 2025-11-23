<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionSupervisorDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @throws \Throwable
     */
    public function procesar(CompraRequisicion $requisicion, Request $request)
    {

        try {
            DB::beginTransaction();

            $requisicion->supervisorVistoBueno($request->comentario ?? null);

            $requisicion->usuario_analista_id = $request->usuario_analista_id;
            $requisicion->save();

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);
            flash($msj)->error();
            return redirect()->route('compra.requisiciones.supervisor');
        }

        DB::commit();

        return redirect()
            ->route('compra.requisiciones.supervisor')
            ->with('success', 'La requisición ha sido procesada con éxito.');

    }

    public function retornar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->supervisorRetornar($request->comentario ?? null);

        return redirect()
            ->route('compra.requisiciones.supervisor')
            ->with('success', 'La requisición ha sido retornada con éxito.');

    }
}
