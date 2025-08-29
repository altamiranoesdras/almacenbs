<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\FirmaElectronica\FirmaElectronica;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Create\CompraRequisicion\CreateCompraRequisicionRequest;
use App\Http\Requests\Update\CompraRequisicion\UpdateCompraRequisicionRequest;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicion\CompraRequisicionEstado;
use App\Models\CompraSolicitudEstado;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CompraRequisicionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicions')->only('show');
        $this->middleware('permission:Crear Compra Requisicions')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicions')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicions')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicion.
     */
    public function index(CompraRequisicionDataTable $compraRequisicionDataTable)
    {
        $scope = new ScopeCompraRequisicion();

        $compraRequisicionDataTable->addScope($scope);

        return $compraRequisicionDataTable->render('compra_requisiciones.index');
    }


    /**
     * Show the form for creating a new CompraRequisicion.
     */
    public function create()
    {
        return view('compra_requisiciones.create');
    }

    /**
     * Store a newly created CompraRequisicion in storage.
     */
    public function store(CreateCompraRequisicionRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::create($input);

        flash()->success('Compra Requisicion guardado.');

        return redirect(route('compra.requisiciones.index'));
    }

    /**
     * Display the specified CompraRequisicion.
     */
    public function show($id)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compra.requisiciones.index'));
        }

        return view('compra_requisiciones.show')->with('compraRequisicion', $compraRequisicion);
    }

    /**
     * Show the form for editing the specified CompraRequisicion.
     */
    public function edit($id)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compra.requisiciones.index'));
        }

        return view('compra_requisiciones.edit')->with('compraRequisicion', $compraRequisicion);
    }

    /**
     * Update the specified CompraRequisicion in storage.
     */
    public function update($id, UpdateCompraRequisicionRequest $request)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compra.requisiciones.index'));
        }

        $compraRequisicion->fill($request->all());
        $compraRequisicion->save();

        if($request->solicitar){
            if($compraRequisicion->tiene_firma_solicitante){
                $compraRequisicion->solicitar();
                flash()->success('Requisición de compra solicitada.');
                return redirect(route('compra.requisiciones.mis.requisiciones'));
            }else{
                flash()->error('Debe firmar la requisición para poder solicitarla.');
                return redirect()->back();
            }
        }

        flash()->success('Compra Requisición actualizado.');

        return redirect(route('compra.requisiciones.mis.requisiciones'));
    }

    /**
     * Remove the specified CompraRequisicion from storage.
     *
     * @throws \Exception
     */

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            /** @var CompraRequisicion $compraRequisicion */
            $compraRequisicion = CompraRequisicion::find($id);

            if (empty($compraRequisicion)) {
                flash()->error('Compra Requisicion no encontrado');
                return redirect(route('compra.requisiciones.mis.requisiciones'));
            }

            $solicitudesAsignadas = $compraRequisicion->compraSolicitudes;

            foreach ($solicitudesAsignadas as $index => $solicitudesAsignada) {
                $solicitudesAsignada->estado_id = CompraSolicitudEstado::SOLICITADA;
                $solicitudesAsignada->save();
            }

            $compraRequisicion->compraSolicitudes()->detach();
            $compraRequisicion->detalles()->delete();
            $compraRequisicion->delete();
        });

        flash()->success('Requisición de compra eliminada.');
        return redirect(route('compra.requisiciones.mis.requisiciones'));
    }


//    public function pdf(CompraRequisicion $requisicion)
//    {
//
//        $pdf = App::make('snappy.pdf.wrapper');
//
//        $view = view('compra_requisiciones.pdfs.requisicion_pdf', compact('requisicion'))->render();
//
//        $pdf->loadHTML($view)
//            ->setOption('page-width', 279)
//            ->setOption('page-height', 216)
//            ->setOrientation('landscape')
//            ->setOption('margin-top', 8)
//            ->setOption('margin-bottom',10)
//            ->setOption('margin-left',10)
//            ->setOption('margin-right',15);
//
//        return $pdf->inline('Despacho '.$requisicion->id. '_'. time().'.pdf');
//    }



    public function pdf(CompraRequisicion $requisicion, Request $request)
    {
        // 1) Generar el PDF con Snappy (wkhtmltopdf)
        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('compra_requisiciones.pdfs.requisicion_pdf', compact('requisicion'))->render();

        $pdf->loadHTML($view)
            ->setOption('page-width', 279)   // mm
            ->setOption('page-height', 216)  // mm
            ->setOrientation('landscape')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 15);

        // 2) Guardar el PDF en storage/app/public/firmas/pdfs
        $disk = 'public';
        $folderPdf = 'requisiciones/generadas';              // carpeta para PDFs generados (previos a la firma)
        $filename = 'Requisicion_' . $requisicion->id . '_' . time() . '.pdf';
        $relativePdfPath = $folderPdf . '/' . $filename;

        $binary = $pdf->output();
        Storage::disk($disk)->put($relativePdfPath, $binary);

        // 3) Envolver el archivo como UploadedFile para pasarlo al firmador
        $absolutePdfPath = Storage::disk($disk)->path($relativePdfPath);
        $uploaded = new UploadedFile(
            $absolutePdfPath,
            $filename,
            'application/pdf',
            null,
            true // test mode (no mueve/elimina el archivo fuente)
        );

        // 4) Firmar usando tu mismo builder
        $rutaArchivoFirmado = (new FirmaElectronica())
            ->respuestaRuta()
            ->setDisco($disk)                                            // dónde guardará el documento firmado
            ->setDirectorio('requisiciones/firmadas')                           // carpeta de salida de firmados (pública)
            ->setCorreo($request->usuario_firma)                         // credenciales del proveedor de firma
            ->setClaveFirma($request->password_firma)
            ->setRubricaUsuario(auth()->user()->rubrica ?? null)    // o la rúbrica del usuario
            ->setInicioX(-30)                                        // coordenadas opcionales
            ->setInicioY(218)
            ->setAncho(225)
            ->setAlto(50)
            ->setLugar('Guatemala, Guatemala')                      // opcional
            ->setTipoSolicitud('PDF')                               // opcional
            ->setConcepto('Requisición de compra')             // opcional
            ->setDocumento($uploaded)                                   // ← el PDF recién creado
            ->firmarDocumento();

        return redirect()->back()
            ->with('success', 'PDF generado y firmado correctamente.')
            ->with('rutaArchivoFirmado', $rutaArchivoFirmado);


        // 4) Asociar el documento
    }
}
