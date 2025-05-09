<?php

namespace App\Http\Controllers;

use App\DataTables\CompraSolicitudDataTable;
use App\Http\Requests\CreateCompraSolicitudRequest;
use App\Http\Requests\UpdateCompraSolicitudRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraSolicitud;
use App\Models\CompraSolicitudDetalle;
use App\Models\CompraSolicitudEstado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class CompraSolicitudController extends AppBaseController
{

    /**
     * Display a listing of the CompraSolicitud.
     *
     * @param CompraSolicitudDataTable $compraSolicitudDataTable
     * @return Response
     */
    public function index(CompraSolicitudDataTable $compraSolicitudDataTable)
    {
        return $compraSolicitudDataTable->render('compra_solicitudes.index');
    }

    /**
     * Show the form for creating a new CompraSolicitud.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create()
    {
        $usuario = auth()->user();

        if ($usuario->unidad_id == null) {

            $errores= [];
            $errores[] = 'No se puede crear una solicitud de compra si el usuario no tiene unidad asignada.';

            return redirect(route('compraSolicitudes.index'))
                ->withErrors($errores);
        }

        $compraSolicitud = $this->getTemporal();

        return view('compra_solicitudes.formulario', compact('compraSolicitud'));
    }

    /**
     * Store a newly created CompraSolicitud in storage.
     *
     * @param CreateCompraSolicitudRequest $request
     *
     * @return Response
     */
    public function store(CreateCompraSolicitudRequest $request)
    {
        $request->merge([
            'partidas' => implode(',', $request->partidas ?? []),
            'subproductos' => implode(',', $request->subproductos ?? []),
        ]);

        $input = $request->all();


        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::create($input);

        flash()->success('Compra Solicitud saved successfully.');

        return redirect(route('compraSolicitudes.index'));
    }

    /**
     * Display the specified CompraSolicitud.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud not found');

            return redirect(route('compraSolicitudes.index'));
        }

        return view('compra_solicitudes.show')->with('compraSolicitud', $compraSolicitud);
    }

    /**
     * Show the form for editing the specified CompraSolicitud.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud not found');

            return redirect(route('compraSolicitudes.index'));
        }

        return view('compra_solicitudes.formulario')->with('compraSolicitud', $compraSolicitud);
    }

    /**
     * Update the specified CompraSolicitud in storage.
     *
     * @param int $id
     * @param UpdateCompraSolicitudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompraSolicitudRequest $request)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud not found');

            return redirect(route('compraSolicitudes.index'));
        }


        if($request->has('partidas')){
            $request->merge([
                'partidas' => implode('|', $request->partidas),
            ]);
        }

        if($request->has('subproductos')){
            $request->merge([
                'subproductos' => implode('|', $request->subproductos),
            ]);
        }


        $compraSolicitud->fill($request->all());
        $compraSolicitud->establecerCodigo();
        $compraSolicitud->save();

        if ($request->procesar){


            try {
                DB::beginTransaction();

                $this->generarCompra($compraSolicitud);

            } catch (Exception $exception) {
                DB::rollBack();

                $msj = manejarException($exception);

                flash($msj)->error();

                return redirect(route('compra.solicitudes.edit',$compraSolicitud->id));
            }

            DB::commit();

            flash('Cotización procesada correctamente.')->success();

            return redirect(route('compras.create'));
        }

        flash('Listo!')->success();

        return redirect(route('compraSolicitudes.edit', $compraSolicitud->id));
    }

    /**
     * Remove the specified CompraSolicitud from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud not found');

            return redirect(route('compraSolicitudes.index'));
        }

        $compraSolicitud->delete();

        flash()->success('Compra Solicitud deleted successfully.');

        return redirect(route('compraSolicitudes.index'));
    }


    public function getTemporal()
    {
        $compraSolicitud = CompraSolicitud::where('usuario_solicita', auth()->user()->id)
            ->where('estado_id', CompraSolicitudEstado::TEMPORAL)
            ->where('bodega_id', session('tienda'))
            ->first();

        if (empty($compraSolicitud)) {
            $compraSolicitud = CompraSolicitud::create([
                'usuario_solicita' => auth()->user()->id,
                'estado_id' => CompraSolicitudEstado::TEMPORAL,
                'bodega_id' => session('tienda'),
                'unidad_id' => auth()->user()->unidad_id,
            ]);
        }

        $compraSolicitud->establecerCodigo();

        return $compraSolicitud;

    }


    public function generarCompra(CompraSolicitud $compraSolicitud)
    {
        $compraSolicitud->estado_id = CompraSolicitudEstado::PROCESADA;
        $compraSolicitud->usuario_procesa = auth()->user()->id;
        $compraSolicitud->save();

        $temporal = $this->getCompraTemporal($compraSolicitud);


        //se crean detalles de venta temporal a partir de los detalles de cotizacion
        $detalles = $compraSolicitud->detalles->map(function (CompraSolicitudDetalle  $detalle)  {

            return  new TempCompraDetalle([
                'item_id' => $detalle->item_id,
                'cantidad' => $detalle->cantidad,
                'precio' => $detalle->precio_compra,
            ]);
        });


        //se asocia la solicitud de compra y cliente a la venta temporal
        $temporal->solicitud_id = $compraSolicitud->id;
        $temporal->proveedor_id = $compraSolicitud->proveedor_id ?? null;
        $temporal->save();

        //se eliminan los detalles de venta temporal y se crean los nuevos
        $temporal->detalles()->delete();
        $temporal->detalles()->saveMany($detalles);


//        dd($temporal->toArray(),$detalles->toArray());

        return $temporal;


    }



    public function pdfVista(CompraSolicitud $compraSolicitud)
    {

        return view('compra.solicitudes.vista_pdf', compact('compraSolicitud'));
    }



    public function pdf(CompraSolicitud $compraSolicitud)
    {

        $pdf = Pdf::loadView('compra_solicitudes.pdf', compact('compraSolicitud'));

        // Configurar opciones de tamaño de página y orientación
        // Tamaño carta y orientación vertical
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('Requision_'.$compraSolicitud->id.'_'.time().'.pdf');
    }


    public function anular(CompraSolicitud $compraSolicitud)
    {
        $compraSolicitud->estado_id = CompraSolicitudEstado::ANULADA;
        $compraSolicitud->save();

        flash('Solicitud de compra anulada correctamente.')->success();

        return redirect(route('compraSolicitudes.index'));

    }
}
