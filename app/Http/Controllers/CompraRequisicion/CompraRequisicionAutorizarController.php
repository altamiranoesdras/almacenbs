<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionAutorizarDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\FirmaElectronica\FirmaElectronica;
use App\Http\Controllers\Controller;
use App\Models\CompraBandeja;
use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class CompraRequisicionAutorizarController extends Controller
{
    public function index(CompraRequisicionAutorizarDataTable $dataTable)
    {

        $bandeja = CompraBandeja::find(CompraBandeja::AUTORIZADOR_DE_COMPRAS);

        $scope = new ScopeCompraRequisicion();

        $scope->bandeja = $bandeja;

        $dataTable->addScope($scope);

        return $dataTable->render('compra_requisiciones.autorizar.index');

    }

    public function seguimiento(CompraRequisicion $requisicion)
    {
        return view('compra_requisiciones.autorizar.seguimiento', compact('requisicion'));
    }

    public function autorizar(CompraRequisicion $requisicion)
    {
        $requisicion->autorizar();

        return redirect()
            ->route('compra.requisiciones.autorizar')
            ->with('success', 'La requisición ha sido autorizada con éxito.');

    }

    public function autorizadorFirmarEImprimir(CompraRequisicion $requisicion, Request $request)
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

        $media = $requisicion
            ->getMedia(CompraRequisicion::COLLECTION_REQUISICION_COMPRA)
            ->last();

        $uploaded = new UploadedFile(
            $media->getPath(),
            'requisicion.pdf',
            'application/pdf',
            null,
            true // test mode (no mueve/elimina el archivo fuente)
        );

        $y = 280;
        $disk = 'public';

        foreach ($requisicion->detalles as $index => $detalle) {
            if($index > 15) {
                $y -= 13;
            }
        }

        // 4) Firmar usando tu mismo builder
        $rutaArchivoFirmado = (new FirmaElectronica())
            ->respuestaRuta()
            ->setDisco($disk)                                            // dónde guardará el documento firmado
            ->setDirectorio('requisiciones/firmadas')                           // carpeta de salida de firmados (pública)
            ->setCorreo($request->usuario_firma)                         // credenciales del proveedor de firma
            ->setClaveFirma($request->password_firma)
            ->setRubricaUsuario(auth()->user()->rubrica ?? null)    // o la rúbrica del usuario
            ->setInicioX(300)                                        // coordenadas opcionales
            ->setInicioY($y)                                        // coordenadas opcionales
            ->setAncho(200)
            ->setAlto(35)
            ->setLugar('Guatemala, Guatemala')                      // opcional
            ->setTipoSolicitud('PDF')                               // opcional
            ->setConcepto('Requisición de compra')             // opcional
            ->setDocumento($uploaded)                                   // ← el PDF recién creado
            ->firmarDocumento();

        $requisicion->update([
            'tiene_firma_autorizador' => true,
        ]);

        $media = $requisicion
            ->addMediaFromDisk($rutaArchivoFirmado, $disk)
            ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);


        return redirect()->back()
            ->with('success', 'PDF generado y firmado correctamente.')
            ->with('rutaArchivoFirmado', $media->getUrl());

        // 4) Asociar el documento
    }
}
