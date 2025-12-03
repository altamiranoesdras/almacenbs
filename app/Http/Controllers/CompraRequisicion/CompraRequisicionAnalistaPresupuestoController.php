<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAnalistaPresupuestoDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicionEstado;
use DB;
use Exception;
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
    public function seguimientoConFirma(CompraRequisicion $requisicion)
    {
        return view('compra_requisiciones.analista_presupuesto.seguimiento_con_firma', compact('requisicion'));
    }

    /**
     * @throws Throwable
     */
    public function procesar(CompraRequisicion $requisicion, Request $request)
    {
        $idsRequeridos = $requisicion->detalles->modelKeys();
        $rawDatos = $request->input('fuentes_financiamiento', []);

        $datosValidos = array_filter($rawDatos, function($valor) {
            return !empty($valor) && $valor !== 'null';
        });

        throw_if(
            count(array_diff($idsRequeridos, array_keys($datosValidos))) > 0,
            ValidationException::withMessages([
                'fuentes_financiamiento' => 'Faltan fuentes de financiamiento para algunos detalles.',
            ])
        );

        try {
            DB::transaction(function () use ($requisicion, $request, $datosValidos) {
                $requisicion->analistaPresupuestoVistoBueno($request->observaciones);
                foreach ($requisicion->detalles as $detalle) {
                    $detalle->update([
                        'financiamiento_fuente_id' => (int) $datosValidos[$detalle->id],
                    ]);
                }
            });

        } catch (Exception $e) {

            $msj = manejarException($e);

            flash($msj)->error();

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Error al procesar: ' . $e->getMessage()]);
        }

        if($requisicion->estado_id = CompraRequisicionEstado::AUTORIZADA){
            flash('Requisición enviada a Supervisor.')->success();
        } else {
            flash('Requisición enviada a Requirente.')->success();
        }

        return redirect()->route('compra.requisiciones.analista.presupuesto');
    }

    public function retornar(CompraRequisicion $requisicion, Request $request)
    {
        $requisicion->analistaPresupuestoRetorna($request->comentario ?? null);

        return redirect()
            ->route('compra.requisiciones.analista.presupuesto')
            ->with('success', 'La requisición ha sido retornada con éxito.');

    }

    public function firmarEImprimir(CompraRequisicion $requisicion, Request $request)
    {

        if ($requisicion->tiene_firma_analista_presupuesto) {
            return redirect()
                ->back()
                ->with('error', 'La requisición ya tiene la firma del analista de presupuesto.')
                ->with('rutaArchivoFirmado', $requisicion->getLastMediaUrl(CompraRequisicion::COLLECTION_REQUISICION_COMPRA));
        }

        $request->validate([
            'usuario_firma'   => ['required','string'],
            'password_firma'  => ['required','string'],
        ]);


        try {
            DB::beginTransaction();

            $media = $requisicion->firmaAnalistaPresupuesto($request->password_firma);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        return redirect()->back()
            ->with('success', 'PDF generado y firmado correctamente.')
            ->with('rutaArchivoFirmado', $media->getUrl());
    }
}
