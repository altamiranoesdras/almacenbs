<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeSolicitudDataTable;
use App\DataTables\SolicitudDataTable;
use App\DataTables\SolicitudDespachaDataTable;
use App\DataTables\SolicitudUserDataTable;
use App\Events\EventoCambioEstadoSolicitud;
use App\Http\Requests;
use App\Http\Requests\CreateSolicitudRequest;
use App\Http\Requests\UpdateSolicitudeRequest;
use App\Http\Requests\UpdateSolicitudRequest;
use App\Mail\DespacharSolicitud;
use App\Mail\SolicitudStock;
use App\Mail\StockCriticoPorSolicitudMail;
use App\Models\Item;
use App\Models\Kardex;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\Solicitude;
use App\Models\SolicitudEstado;
use App\Models\TempSolicitude;
use App\Models\Tienda;
use Carbon\Carbon;
use Exception;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Response;
use Illuminate\Support\Facades\App;

class SolicitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Solicitud')->only(['show']);
        $this->middleware('permission:Crear Solicitud')->only(['create','store','preImpreso']);
        $this->middleware('permission:Editar Solicitud')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Solicitud')->only(['destroy']);
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

        flash()->success('Solicitud guardado exitosamente.');

        return redirect(route('solicitudes.index'));
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
            flash()->error('Solicitud no encontrado');

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
            flash()->error('Solicitud no encontrado');

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
            flash()->error('Solicitud no encontrado');

            return redirect(route('solicitudes.index'));
        }


        if ($request->solicitar){

            $errores = $this->validaStock($solicitud);

            if (count($errores) > 0){
                return redirect(route('solicitudes.edit',$solicitud->id) )->withInput()->withErrors($errores);
            }

        }

        try {
            DB::beginTransaction();


            $this->procesar($solicitud,$request);


        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();



        flash()->success('Requisición procesada con éxito.');

        return redirect(route('solicitudes.usuario'));



    }

    public function procesar(Solicitud $solicitud,UpdateSolicitudRequest $request){


        if ($request->solicitar){

            $request->merge([
                'codigo' => $this->getCodigo(),
                'correlativo' => $this->getCorrelativo(),
                'usuario_solicita' => $request->usuario_solicita,
                'fecha_solicita' => hoyDb(),
                'estado_id' => SolicitudEstado::SOLICITADA,
            ]);


            $solicitud->fill($request->all());
            $solicitud->save();

//            Mail::send(new SolicitudStock($solicitud));
            event(new EventoCambioEstadoSolicitud($solicitud));

            return $solicitud;
        }else{

            $request->merge([
                'estado_id' => SolicitudEstado::INGRESADA,
            ]);


            $solicitud->fill($request->all());
            $solicitud->save();

        }

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
            flash()->error('Solicitud no encontrado');

            return redirect(route('solicitudes.index'));
        }

        $solicitud->delete();

        flash()->success('Solicitud deleted successfully.');

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


        flash()->success('Listo! solicitud anulada.');

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
        return $pdf->inline('requision '.$solicitud->id.'.pdf');

    
    }

}
