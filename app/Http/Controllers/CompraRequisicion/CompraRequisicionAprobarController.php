<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAprobarDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraRequisicionAprobarController extends Controller
{
    public function index(CompraRequisicionAprobarDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::APROBADOR_DE_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.aprobar.index',compact('bandeja'));

    }

    public function seguimiento(CompraRequisicion $requisicion)
    {
        return view('compra_requisiciones.aprobar.seguimiento', compact('requisicion'));
    }

    public function aprobadorFirmarEImprimir(CompraRequisicion $requisicion, Request $request)
    {

        if ($requisicion->tiene_firma_aprobador) {
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

            $media = $requisicion->firmaOperador($request->password_firma);
            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        return redirect()->back()
            ->with('success', 'PDF generado y firmado correctamente.')
            ->with('rutaArchivoFirmado', $media->getUrl());
    }

    public function aprobar(CompraRequisicion $requisicion)
    {
        $requisicion->aprobar();

        flash('La requisición ha sido aprobada correctamente.')->success();
        return redirect()->route('compra.requisiciones.aprobar');

    }
}
