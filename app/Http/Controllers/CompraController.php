<?php

namespace App\Http\Controllers;

use App\DataTables\CompraDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Http\Requests\CreateCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\Compra;
use App\Models\Compra1h;
use App\Models\CompraEstado;
use App\Models\Item;
use App\Models\Proveedor;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class CompraController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compras')->only(['show']);
        $this->middleware('permission:Crear Compras')->only(['create','store']);
        $this->middleware('permission:Editar Compras')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Compras')->only(['destroy']);
    }

    /**
     * Display a listing of the Compra.
     *
     * @param CompraDataTable $compraDataTable
     * @param Request $request
     * @return Response
     */
    public function index(CompraDataTable $compraDataTable, Request $request)
    {

        $scope = new ScopeCompraDataTable();

        //si es la primera carga de la página es decir no se ha hecho ningún filtro
        if ( count($request->all()) == 0 ) {
            $scope->del =  iniMesDb();
            $scope->al =  hoyDb();
        }

        $compraDataTable->addScope($scope);

        $subtitulo='';

        if ($request->proveedor_id){
            $proveedor = Proveedor::find($request->proveedor_id);
            $subtitulo .=  "<br> Cliente: ".$proveedor->nombre;
        }

        if ($request->item_id){
            $item = Item::find($request->item_id);
            $marca_nombre = $item->marca->nombre ?? null;
            $subtitulo .=  "<br> Artículo: ".$item->nombre.' / '.$marca_nombre;
        }


        if ($request->estado_id){
            $sts = CompraEstado::find($request->estado_id);
            $subtitulo .=  "<br> Estado: ".$sts->nombre;
        }

        if ($scope->del && $scope->al){
            $subtitulo .=  "<br> Del: ".fecha($scope->del).' - Al: '.fecha($scope->al);
        }

        $compraDataTable->setTitulo('Reporte de Compras');
        $compraDataTable->setSubtitulo($subtitulo);

        return $compraDataTable->render('compras.index');
    }

    /**
     * Show the form for creating a new Compra.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        $temporal = $this->compraTemporal();

//        dd($temporal->detalles->first()->toArray());

        return view('compras.create',compact('temporal'));
    }

    /**
     * Store a newly created Compra in storage.
     *
     * @param CreateCompraRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function store(CreateCompraRequest $request)
    {
        $input = $request->all();

        Compra::create($input);

        flash()->success('Compra guardado exitosamente.');

        return redirect(route('compras.index'));
    }

    /**
     * Display the specified Compra.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function show(int $id)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            flash()->error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        return view('compras.show')->with('compra', $compra);
    }

    /**
     * Show the form for editing the specified Compra.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function edit(int $id)
    {
        /** @var Compra $compra */
        $compra = Compra::with(['detalles' => function ($q){ $q->whereHas('item'); }])->find($id);

        /**
         * @var Compra1h $compra1h
         */
        $compra1h = Compra1h::with(['detalles' => function ($q){ $q->whereHas('item'); }])->where('compra_id', $compra->id)->first();


        if (empty($compra)) {
            flash()->error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        return view('compras.edit', compact('compra', 'compra1h'));
    }

    /**
     * Update the specified Compra in storage.
     *
     * @param int $id
     * @param UpdateCompraRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     * @throws Throwable
     */
    public function update(int $id, UpdateCompraRequest $request)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            flash()->error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        try {
            DB::beginTransaction();

            $this->procesar($compra,$request);

        } catch (Exception $exception) {

            DB::rollBack();

            $msj = manejarException($exception);

            flash($msj)->error();

            return redirect()->back();
        }

        DB::commit();

        flash('Listo! compra procesada.')->success();

        return redirect(route('compras.edit', $compra->id));

    }

    public function actualizarProcesada(Compra $compra,Request $request)
    {
//        dd($compra->toArray(),$request->all());

        $compra->fill($request->all());
        $compra->save();

        flash('Listo! compra actualizada.')->success();

        return redirect(route('compras.edit', $compra->id));
    }

    public function procesar(Compra $compra,UpdateCompraRequest $request){



        $request->merge([
            'estado_id' => CompraEstado::PROCESADO_PENDIENTE_RECIBIR,
            'codigo' => $this->getCodigo(),
            'correlativo' => $this->getCorrelativo(),
        ]);

        $compra->fill($request->all());
        $compra->save();

        if ($request->ingreso_inmediato){
            $compra->procesaIngreso();
        }


//        if($compra){
//            //Mail::send(new OrdenCompra($compra));
//        }

        return $compra;
    }

    /**
     * Remove the specified Compra from storage.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     * @throws Exception
     *
     */
    public function destroy(int $id)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            flash()->error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        $compra->delete();

        flash()->success('Ingreso almacén eliminado exitosamente.');

        return redirect(route('compras.index'));
    }

    public function compraTemporal()
    {

        $user = auth()->user();

        $compra = Compra::temporal()->delUsuarioCrea()->first();


        if (!$compra){

            $compra =  Compra::create([
                'usuario_crea' => $user->id,
                'estado_id' => CompraEstado::TEMPORAL,
            ]);
        }

        return $compra;
    }


    public function getCodigo($cantidadCeros = 1)
    {
        return "CPA-".prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = Compra::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

    /**
     * @throws Throwable
     */
    public function anular(Compra $compra){

        $justificativa_anulacion = request()->justificativa_anulacion;
        try {
            DB::beginTransaction();

            $compra->anular();


            $compraH1 = $compra->compra1h;
            $compraH1->justificativa_anulacion = $justificativa_anulacion;
            $compraH1->save();

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash()->error($msj);

            return redirect()->back();
        }


        DB::commit();


        flash()->success('Listo! compra anulada.');

        return redirect(route('compras.index'));
    }

    /**
     * @throws Throwable
     */
    public function ingreso($id){


        try {
            DB::beginTransaction();

            $compra = Compra::with('detalles.item.stocks')->find($id);

            $compra->procesaIngreso();

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash($msj)->error();

            return redirect()->back();
        }


        DB::commit();

        flash('Ingreso Realizado')->success();


        return redirect(route('bandejas.compras1h.operador.gestionar', $compra->id));

    }

    /**
     * @throws Throwable
     */
    public function pdf(Compra $compra){

//        dd('este es el metodo que genera el pdf', $compra->toArray());

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('compras.pdf', compact('compra'))->render();
        $footer = view('compras.pdf_footer')->render();

        $pdf->loadHTML($view)
            ->setOption('page-width', 216)
            ->setOption('page-height', 278)
            ->setOrientation('portrait')
            ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 2)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 0)
            ->setOption('margin-right', 0)
            ->inline('report.pdf');

        return $pdf->inline();


    }


    /**
     * @throws Throwable
     */
    public function pdfH1(Compra $compra)
    {

//        return $compra->compra1hs->first()->compra1hDetalles;
//        return $compra->compra1hs->first();
        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('compras.pdfH1', compact('compra'))->render();

        $pdf->loadHTML($view)
           ->setOption('page-width', 217)
           ->setOption('page-height', 278)
            ->setOrientation('portrait')
            // ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 31)
            ->setOption('margin-bottom',3)
            ->setOption('margin-left',9)
            ->setOption('margin-right',17);
        // ->stream('report.pdf');

        return $pdf->inline('CompraH1-'.$compra->id. '_'. time().'.pdf');
    }

//    public function pdfH1Digital(Compra $compra)
//    {
//        $pdf = App::make('snappy.pdf.wrapper');
//
//        $envioFiscal = $compra->compra1h->envioFiscal;
//
//        // Renderizamos una sola copia de la vista
//        $view = view('compras.pdfH1_digital', compact('compra'))->render();
//        $footer = view('compras.pdfH1_digital_footer', compact('compra', 'envioFiscal'))->render();
//
//        // Queremos, por ejemplo, 3 copias
//        $copias = 2;
//        $contenido = '';
//        for ($i = 1; $i <= $copias; $i++) {
//            $contenido .= $view;
//
//            // Si quieres que cada copia empiece en una nueva hoja:
//            if ($i < $copias) {
//                $contenido .= '<div style="page-break-after: always;"></div>';
//            }
//        }
//
//        $pdf->loadHTML($contenido)
//            ->setOption('footer-html', utf8_decode($footer))
//            ->setOption('page-width', 217)
//            ->setOption('page-height', 278)
//            ->setOrientation('portrait')
//            ->setOption('margin-top', 10)
//            ->setOption('margin-bottom', 95)
//            ->setOption('margin-left', 15)
//            ->setOption('margin-right', 15);
//
//        return $pdf->inline('CompraH1-'.$compra->id. '_'. time().'.pdf');
//    }

    public function pdfH1Digital(Compra $compra)
    {
        $pdf = App::make('snappy.pdf.wrapper');

        $envioFiscal = $compra->compra1h->envioFiscal;


        $copias = 2;
        $contenido = '';
        for ($i = 1; $i <= $copias; $i++) {
            $textoFooter = $i == 1 ? '- Original: Contabilidad -' : '- Duplicado: Almacen -';
            $view = view('compras.pdfH1_digital_con_footer', compact('compra', 'envioFiscal', 'textoFooter'))->render();
            $contenido .= $view;

            if ($i < $copias) {
                $contenido .= '<div style="page-break-after: always;"></div>';
            }
        }

        $pdf->loadHTML($contenido)
//            ->setOption('footer-html', utf8_decode($footer))
            ->setOption('page-width', 217)
            ->setOption('page-height', 278)
            ->setOrientation('portrait')
            ->setOption('margin-top', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 15)
            ->setOption('margin-right', 15);

        return $pdf->inline('CompraH1-'.$compra->id. '_'. time().'.pdf');
    }


}
