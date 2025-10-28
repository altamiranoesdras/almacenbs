<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudDataTable;
use App\DataTables\SolicitudUserDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Http\Requests\CreateSolicitudRequest;
use App\Http\Requests\UpdateSolicitudRequest;
use App\Models\Bodega;
use App\Models\EnvioFiscal;
use App\Models\RrhhUnidad;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
use App\Models\User;
use App\Notifications\RequisicionSolicitidaNotificacion;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Response;

class SolicitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Requisición')->only(['show']);
        $this->middleware('permission:Crear Requisición')->only(['create','store','preImpreso']);
        $this->middleware('permission:Editar Requisición')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Requisición')->only(['destroy']);
    }

    /**
     * Display a listing of the Solicitud.
     *
     * @param SolicitudDataTable $solicitudDataTable
     * @return Response
     */
    public function index(SolicitudDataTable $solicitudDataTable)
    {
        $scope = new ScopeSolicitudDataTable();

        $estadosIniciales =  [
            SolicitudEstado::SOLICITADA,
            SolicitudEstado::AUTORIZADA,
            SolicitudEstado::APROBADA,
            SolicitudEstado::DESPACHADA,
            SolicitudEstado::ANULADA,
            SolicitudEstado::CANCELADA,
            SolicitudEstado::RETORNO_POR_AUTORIZADOR,
            SolicitudEstado::RETORNO_POR_DESPACHO,
        ];

        $scope->estados = request()->estados ?? $estadosIniciales;

        $solicitudDataTable->addScope($scope);


        return $solicitudDataTable->render('solicitudes.index');
    }

    public function user(SolicitudUserDataTable $solicitudDataTable)
    {
        $estados = [
            SolicitudEstado::INGRESADA,
            SolicitudEstado::SOLICITADA,
            SolicitudEstado::AUTORIZADA,
            SolicitudEstado::APROBADA,
            SolicitudEstado::DESPACHADA,
            SolicitudEstado::RETORNO_POR_AUTORIZADOR,
            SolicitudEstado::RETORNO_POR_DESPACHO,
        ];

        $scope = new ScopeSolicitudDataTable();
        $scope->estados = request()->estados ?? $estados;
        $scope->usuarios_solicita = auth()->user()->id;

        $solicitudDataTable->addScope($scope);

        $estados = SolicitudEstado::whereIn('id',$estados)->get();

        return $solicitudDataTable->render('solicitudes.usuario.index',compact('estados'));
    }

    /**
     * Show the form for creating a new Solicitud.
     *
     * @return Response
     */
    public function create()
    {
        $solicitud = $this->obtenerTemporal();

        return view('solicitudes.create',compact('solicitud'));
    }

    /**
     * Store a newly created Solicitud in storage.
     *
     * @param CreateSolicitudRequest $request
     *
     * @return Response
     */
    public function store(CreateSolicitudRequest $request)
    {
        $input = $request->all();

        /** @var Solicitud $solicitud */
        $solicitud = Solicitud::create($input);

        flash()->success('Requisición guardada exitosamente.');

        return redirect(route('solicitudes.edit',$solicitud->id));
    }

    /**
     * Display the specified Solicitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Solicitud $solicitud */
        $solicitud = Solicitud::find($id);

        if (empty($solicitud)) {
            flash()->error('Requisición no encontrado');

            return redirect(route('solicitudes.index'));
        }

        return view('solicitudes.show')->with('solicitud', $solicitud);
    }

    /**
     * Show the form for editing the specified Solicitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Solicitud $solicitud */
        $solicitud = Solicitud::find($id);

        if (empty($solicitud)) {
            flash()->error('Requisición no encontrado');

            return redirect(route('solicitudes.index'));
        }

        return view('solicitudes.create',compact('solicitud'));
    }

    /**
     * Update the specified Solicitud in storage.
     *
     * @param  int              $id
     * @param UpdateSolicitudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSolicitudRequest $request)
    {
        /** @var Solicitud $solicitud */
        $solicitud = Solicitud::withoutGlobalScope('noTemporal')->with('detalles.item.stocks')->find($id);


        if (empty($solicitud)) {
            flash()->error('Requisición no encontrado');

            return redirect(route('solicitudes.index'));
        }


        if ($request->solicitar){

            $errores = $this->validaStock($solicitud);

            if (count($errores) > 0){
                return redirect(route('solicitudes.edit',$solicitud->id) )->withInput()->withErrors($errores);
            }


            try {
                DB::beginTransaction();

                $this->enviarNotificacion($solicitud);

                $this->procesar($solicitud,$request);


            } catch (Exception $exception) {
                DB::rollBack();

                throw new Exception($exception);
            }

            DB::commit();



            flash()->success('Requisición enviada para autorización.');

            return redirect(route('solicitudes.usuario'));

        }else{

            $request->merge([
                'estado_id' => SolicitudEstado::INGRESADA,
            ]);


            $solicitud->fill($request->all());
            $solicitud->save();

            flash()->success('Requisición guardada exitosamente.');

            return redirect(route('solicitudes.edit',$solicitud->id));

        }




    }

    public function procesar(Solicitud $solicitud,UpdateSolicitudRequest $request){



        $request->merge([
            'codigo' => $this->getCodigo(),
            'correlativo' => $this->getCorrelativo(),
            'unidad_id' => auth()->user()->unidad_id ?? RrhhUnidad::PRINCIPAL,
            'bodega_id' => auth()->user()->bodega_id ?? Bodega::PRINCIPAL,
            'usuario_solicita' => $request->usuario_solicita,
            'fecha_solicita' => Carbon::now(),
            'estado_id' => SolicitudEstado::SOLICITADA,
            'envio_fiscal_id' => EnvioFiscal::SOLICITUD,
        ]);


        $solicitud->fill($request->all());
        $solicitud->save();

//            Mail::send(new SolicitudStock($solicitud));

        try{
            event(new EventoCambioEstadoSolicitud($solicitud));
        }catch (Exception $exception){

        }

        $solicitud->addBitacora("REQUISICIÓN SOLICITADA","");


        return $solicitud;

    }


    /**
     * Remove the specified Solicitud from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Solicitud $solicitud */
        $solicitud = Solicitud::find($id);

        if (empty($solicitud)) {
            flash()->error('Requisición no encontrado');

            return redirect(route('solicitudes.index'));
        }

        $solicitud->delete();

        flash()->success('Requisición deleted successfully.');

        return redirect(route('solicitudes.index'));
    }



    public function obtenerTemporal()
    {

        $user = auth()->user();

        $compra = Solicitud::temporal()->delUsuarioCrea()->first();


        if (!$compra){

            $compra =  Solicitud::create([
                'usuario_crea' => $user->id,
                'estado_id' => SolicitudEstado::TEMPORAL,
            ]);
        }

        return $compra;
    }

    public function cancelar(Solicitud $solicitud){

        $solicitud->detalles()->delete();
        $solicitud->delete();

        flash()->success('Listo! solicitud cancelada.');

        return redirect(route('solicitudes.create'));
    }

    public function anular(Solicitud $solicitud){

        try {
            DB::beginTransaction();

            $solicitud->anular();

        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);
        }

        DB::commit();


        flash()->success('Listo! requisición de almacén anulada.');

        return redirect(route('solicitudes.index'));
    }


    public function validaStock(Solicitud $solicitud){

        $errores=array();


        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($solicitud->detalles as $index => $detalle) {

            $item = $detalle->item;
            $stock = $item->stocks->sum('cantidad');

            if($stock < $detalle->cantidad){

                $errores[]= "El articulo ".$item->nombre.", tiene ".nf($stock)." existencias e intenta solicitar ".nf($detalle->cantidad);;

            }
        }

        return $errores;
    }


    public function getCodigo($cantidadCeros = 3)
    {
        return "REQ-".prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = Solicitud::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

    public function preImpreso(Solicitud $solicitud){

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('solicitudes.preimpreso', compact('solicitud'))->render();
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
        return $pdf->inline('Requision '.$solicitud->id. '_'. time().'.pdf');


    }

    public function despachoPdf(Solicitud $solicitud){

        $solicitud->load([
            'detalles.item',
        ]);

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view(config('impresos.requisiciones.solicitud.vista_pdf'), compact('solicitud'))->render();

//        $footer = view('solicitudes.despachar.pdf_footer',compact('solicitud'))->render();

//         return $view;
//        dd($solicitud->toArray());

        $pdf->loadHTML($view)
            ->setOption('page-width', 279)
            ->setOption('page-height', 216)
            ->setOrientation('landscape')
//            ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom',10)
            ->setOption('margin-left',10)
            ->setOption('margin-right',15);

        return $pdf->inline('Despacho '.$solicitud->id. '_'. time().'.pdf');


    }

//    public function despachoPdfDigital(Solicitud $solicitud){
//
//        $solicitud->load([
//            'detalles.item',
//        ]);
//
//        $envioFiscal = $solicitud->envioFiscal;
//        $pdf = App::make('snappy.pdf.wrapper');
//
//        $view = view('solicitudes.despachar.pdfs.pdf_digital', compact('solicitud'))->render();
//
//        $footer = view('solicitudes.despachar.pdf_footer',compact('solicitud', 'envioFiscal'))->render();
//
//        $copias = 2;
//        $contenido = '';
//        for ($i = 1; $i <= $copias; $i++) {
//            $contenido .= $view;
//
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
//            ->setOption('margin-bottom', 90)
//            ->setOption('margin-left', 15)
//            ->setOption('margin-right', 15);
//
//        return $pdf->inline('Despacho '.$solicitud->id. '_'. time().'.pdf');
//
//
//    }

    public function despachoPdfDigital(Solicitud $solicitud){
        $envioFiscal = $solicitud->envioFiscal;
        $pdf = App::make('snappy.pdf.wrapper');

        $copias = 2;
        $contenido = '';
        for ($i = 1; $i <= $copias; $i++) {
            $textoFooter = $i == 1 ? '- Original: Almacén -' : '- Duplicado: Solicitante -';
            $view = view('solicitudes.despachar.pdfs.pdf_digital_con_footer', compact('solicitud', 'envioFiscal', 'textoFooter'))->render();
            $contenido .= $view;

            if ($i < $copias) {
                $contenido .= '<div style="page-break-after: always;"></div>';
            }
        }

        $pdf->loadHTML($contenido)
            ->setOption('page-width', 217)
            ->setOption('page-height', 278)
            ->setOrientation('portrait')
            ->setOption('margin-top', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 15)
            ->setOption('margin-right', 15);

        return $pdf->inline('Despacho '.$solicitud->id. '_'. time().'.pdf');


    }

    public function enviarNotificacion(Solicitud $solicitud)
    {

        //TODO: el correo debe llegar al jefe de la unidad que solicita la requisición
        if(entornoEstaEnProduccion()){

            $usuario = $solicitud->unidad->jefe ?? null;

            $usuario?->notify(new RequisicionSolicitidaNotificacion());

        }

    }

}
