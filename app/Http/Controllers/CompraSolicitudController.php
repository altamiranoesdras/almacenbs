<?php

namespace App\Http\Controllers;

use App\DataTables\CompraSolicitud\MisCompraSolicitudesDataTable;
use App\DataTables\CompraSolicitudDataTable;
use App\DataTables\Scopes\ScopeCompraSolicitudDataTable;
use App\Http\Requests\CreateCompraSolicitudRequest;
use App\Http\Requests\UpdateCompraSolicitudRequest;
use App\Models\CompraSolicitud;
use App\Models\CompraSolicitudDetalle;
use App\Models\CompraSolicitudEstado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CompraSolicitudController extends AppBaseController
{

    /**
     * Display a listing of the CompraSolicitud.
     *
     * @param CompraSolicitudDataTable $compraSolicitudDataTable
     * @return Response
     */
    public function index(CompraSolicitudDataTable $compraSolicitudDataTable, Request $request)
    {

        $scope = new ScopeCompraSolicitudDataTable();

        //si es la primera carga de la pagina es decir no se ha hecho ningun filtro
        if ( count($request->all()) == 0 ) {
            $scope->del =  iniMesDb();
            $scope->al =  hoyDb();
        }

        $compraSolicitudDataTable->addScope($scope);

        // $subtitulo='';

        // if ($request->proveedor_id){
        //     $proveedor = Proveedor::find($request->proveedor_id);
        //     $subtitulo .=  "<br> Cliente: ".$proveedor->nombre;
        // }

        // if ($request->item_id){
        //     $item = Item::find($request->item_id);
        //     $marca_nombre = $item->marca->nombre ?? null;
        //     $subtitulo .=  "<br> Artículo: ".$item->nombre.' / '.$marca_nombre;
        // }


        // if ($request->estado_id){
        //     $sts = CompraEstado::find($request->estado_id);
        //     $subtitulo .=  "<br> Estado: ".$sts->nombre;
        // }

        // if ($scope->del && $scope->al){
        //     $subtitulo .=  "<br> Del: ".fecha($scope->del).' - Al: '.fecha($scope->al);
        // }

        // $compraSolicitudDataTable->setTitulo('Reporte de Compras');
        // $compraSolicitudDataTable->setSubtitulo($subtitulo);



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

            return redirect(route('compra.requisiciones.index'))
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

        return redirect(route('compra.requisiciones.index'));
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

            return redirect(route('compra.requisiciones.index'));
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

            return redirect(route('compra.requisiciones.index'));
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

            return redirect(route('compra.requisiciones.index'));
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
        $compraSolicitud->estado_id = CompraSolicitudEstado::INGRESADA;
        $compraSolicitud->save();

        if($request->solicitar) {
            $compraSolicitud->estado_id = CompraSolicitudEstado::SOLICITADA;
        }


        flash('Listo!')->success();

        return redirect(route('compra.requisiciones.edit', $compraSolicitud->id));
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

            return redirect(route('compra.requisiciones.index'));
        }

        $compraSolicitud->delete();

        flash()->success('Compra Solicitud deleted successfully.');

        return redirect(route('compra.requisiciones.index'));
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

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('compra_solicitudes.pdfs.compra_pdf', compact('compraSolicitud'))->render();

        $pdf->loadHTML($view)
            ->setOption('page-width', 279)
            ->setOption('page-height', 216)
            ->setOrientation('landscape')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom',10)
            ->setOption('margin-left',10)
            ->setOption('margin-right',15);

        return $pdf->inline('Despacho '.$compraSolicitud->id. '_'. time().'.pdf');
    }


    public function anular(CompraSolicitud $compraSolicitud)
    {
        $compraSolicitud->estado_id = CompraSolicitudEstado::ANULADA;
        $compraSolicitud->save();

        flash('Solicitud de compra anulada correctamente.')->success();

        return redirect(route('compra.requisiciones.index'));

    }

    public function misSolicitudesDeCompra(MisCompraSolicitudesDataTable $dataTable)
    {
        /**
         * @var User $usuarioActual
         */
        $usuarioActual = auth()->user();

        $scope = new ScopeCompraSolicitudDataTable($usuarioActual->id);

        $dataTable->addScope($scope);

        return $dataTable->render('compra_solicitudes.mis_solicitudes.index');

    }
}
