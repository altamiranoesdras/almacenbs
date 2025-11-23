<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAnalistaPresupuestoDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

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
        $idsRequeridos = $requisicion->detalles->modelKeys();
        $datosRecibidos = $request->input('fuentes_financiamiento', []);

        throw_if(
            count(array_diff($idsRequeridos, array_keys($datosRecibidos))) > 0,
            ValidationException::withMessages([
                'fuentes_financiamiento' => 'Faltan fuentes de financiamiento para algunos detalles.',
            ])
        );

        try {
            DB::transaction(function () use ($requisicion, $request, $datosRecibidos) {
                $requisicion->analistaPresupuestoVistoBueno($request->comentario);
                foreach ($requisicion->detalles as $detalle) {
                    $detalle->update([
                        'financiamiento_fuente_id' => (int) $datosRecibidos[$detalle->id],
                    ]);
                }
            });

        } catch (Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Error al procesar: ' . $e->getMessage()]);
        }

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
