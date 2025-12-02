<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionRequirenteDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use DB;
use Exception;
use Illuminate\Http\Request;

class CompraRequisicionRequirenteController extends Controller
{
    public function index(CompraRequisicionRequirenteDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::REQUIRENTE_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.requirente.index', compact('bandeja'));

    }

    public function seguimiento(CompraRequisicion $requisicion)
    {
        return view('compra_requisiciones.requirente.seguimiento', compact('requisicion'));
    }

    public function procesar(CompraRequisicion $requisicion)
    {

        if(!$requisicion->tiene_firma_solicitante) {
            return redirect()
                ->back()
                ->with('error', 'La requisición no tiene la firma del solicitante, no se puede procesar.');
        }

        $requisicion->enviarAAprobador();

        return redirect()
            ->route('compra.requisiciones.mis.requisiciones')
            ->with('success', 'La requisición ha sido enviada al aprobador correctamente.');

    }

    public function firmarEImprimir(CompraRequisicion $requisicion, Request $request)
    {

        if ($requisicion->tiene_firma_autorizador) {
            return redirect()
                ->back()
                ->with('error', 'La requisición ya tiene la firma del solicitante.')
                ->with('rutaArchivoFirmado', $requisicion->getLastMediaUrl(CompraRequisicion::COLLECTION_REQUISICION_COMPRA));
        }

        $request->validate([
            'usuario_firma'   => ['required','string'],
            'password_firma'  => ['required','string'],
        ]);


        try {
            DB::beginTransaction();

            $media = $requisicion->firmaRequirente($request->password_firma);

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
