<?php

namespace App\Http\Controllers;

use App\DataTables\CompraSolicitudDataTable;
use App\Http\Requests\CreateCompraSolicitudRequest;
use App\Http\Requests\UpdateCompraSolicitudRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraSolicitud;
use App\Models\CompraSolicitudDetalle;
use App\Models\CompraSolicitudEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
     * @return Response
     */
    public function create()
    {

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
        $input = $request->all();

        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::create($input);

        Flash::success('Compra Solicitud saved successfully.');

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
            Flash::error('Compra Solicitud not found');

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
            Flash::error('Compra Solicitud not found');

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
            Flash::error('Compra Solicitud not found');

            return redirect(route('compraSolicitudes.index'));
        }

        $request->merge([
            'estado_id' => CompraSolicitudEstado::INGRESADA,
        ]);



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

        return redirect(route('compraSolicitudes.index'));
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
            Flash::error('Compra Solicitud not found');

            return redirect(route('compraSolicitudes.index'));
        }

        $compraSolicitud->delete();

        Flash::success('Compra Solicitud deleted successfully.');

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
            ]);
        }
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


    /**
     * @param CompraSolicitud $compraSolicitud
     */
    public function getCompraTemporal(CompraSolicitud $compraSolicitud): TempCompra
    {

        /**
         * @var TempCompra $temporal
         */
        $temporal = TempCompra::where('procesada',0)
            ->where('user_id', $compraSolicitud->usuario_procesa)
            ->first();

        if (empty($temporal)) {
            $temporal = TempCompra::create([
                'user_id' => $compraSolicitud->usuario_procesa,
            ]);
        }

        return $temporal;


    }

    public function pdfVista(CompraSolicitud $compraSolicitud)
    {

        return view('compra.solicitudes.vista_pdf', compact('compraSolicitud'));
    }


    public function pdf(CompraSolicitud $compraSolicitud)
    {
        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('compra_solicitudes.pdf', compact('compraSolicitud'))->render();
        // $footer = view('compras.pdf_footer')->render();

        $pdf->loadHTML($view)
            ->setOption('page-width', '220')
            ->setOption('page-height', '280')
            ->setOrientation('portrait')
            // ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 12)
            ->setOption('margin-bottom',10)
            ->setOption('margin-left',14)
            ->setOption('margin-right',10);
        // ->stream('report.pdf');
        return $pdf->inline('Requision '.$compraSolicitud->id. '_'. time().'.pdf');

    }

    public function anular(CompraSolicitud $compraSolicitud)
    {
        $compraSolicitud->estado_id = CompraSolicitudEstado::ANULADA;
        $compraSolicitud->save();

        flash('Solicitud de compra anulada correctamente.')->success();

        return redirect(route('compraSolicitudes.index'));

    }
}
