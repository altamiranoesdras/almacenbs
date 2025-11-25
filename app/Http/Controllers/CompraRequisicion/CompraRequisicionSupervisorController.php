<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionSupervisorDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicionEstado;
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

    public function procesar(CompraRequisicion $requisicion, Request $request)
    {

        if($requisicion->estado_id == CompraRequisicionEstado::ASIGNACION_REQUISICIONES && !$request->input('usuario_analista_id')){
            return redirect()
                ->back()
                ->withErrors(['error' => 'Debe seleccionar un analista de compras para continuar.'])
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $requisicion->supervisorVistoBueno(
                comentario: $request->input('comentario'),
                usuario_analista_id: $request->input('usuario_analista_id')
            );

            DB::commit();

            return redirect()
                ->route('compra.requisiciones.supervisor')
                ->with('success', 'La requisición ha sido procesada con éxito.');

        } catch (Throwable $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            return redirect()
                ->route('compra.requisiciones.supervisor')
                ->withErrors(['error' => $msj])
                ->withInput();
        }
    }

    public function retornar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->supervisorRetornar($request->comentario ?? null);

        return redirect()
            ->route('compra.requisiciones.supervisor')
            ->with('success', 'La requisición ha sido retornada con éxito.');

    }
}
