<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionDataTable;
use App\DataTables\Scopes\ScopeCompraRequisicion;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Create\CompraRequisicion\CreateCompraRequisicionRequest;
use App\Http\Requests\Update\CompraRequisicion\UpdateCompraRequisicionRequest;
use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraSolicitudEstado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

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
        $requisicion = CompraRequisicion::find($id);

        if (empty($requisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compra.requisiciones.index'));
        }

        return view('compra_requisiciones.edit')->with('requisicion', $requisicion);
    }

    /**
     * Update the specified CompraRequisicion in storage.
     */
    public function update($id, UpdateCompraRequisicionRequest $request)
    {
        $request->validate([
            'justificacion' => 'required|string',
        ]);

        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compra.requisiciones.index'));
        }

        $compraRequisicion->fill($request->all());
        $compraRequisicion->save();

        if($request->solicitar){
            $compraRequisicion->enviarAAnalistaPresupuesto();
            flash()->success('Requisición de compra enviada a analista de presupuestos.');
            return redirect(route('compra.requisiciones.mis.requisiciones'));
        }

        flash()->success('Compra Requisición actualizado.');

        return redirect(route('compra.requisiciones.edit', [$compraRequisicion->id]));
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



    /**
     * Genera el PDF de la requisición, lo firma electrónicamente y lo asocia al modelo.
     * @throws Exception|Throwable
     */
    public function solicitanteFirmarEImprimir(CompraRequisicion $requisicion, Request $request)
    {
        if ($requisicion->tiene_firma_solicitante) {
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

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();


        return redirect()->back()
            ->with('success', 'PDF generado y firmado correctamente.')
            ->with('rutaArchivoFirmado', $media->getUrl());

    }
}
