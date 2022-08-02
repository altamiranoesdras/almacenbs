<?php

namespace App\Http\Controllers;

use App\DataTables\SolicitudDataTable;
use App\DataTables\SolicitudeDespachaDataTable;
use App\DataTables\SolicitudeUserDataTable;
use App\Events\EventSolicitudCreate;
use App\Facades\Correlativo;
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

class SolicitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Solicituds')->only(['show']);
        $this->middleware('permission:Crear Solicituds')->only(['create','store']);
        $this->middleware('permission:Editar Solicituds')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Solicituds')->only(['destroy']);
    }

    /**
     * Display a listing of the Solicitud.
     *
     * @param SolicitudDataTable $solicitudDataTable
     * @return Response
     */
    public function index(SolicitudDataTable $solicitudDataTable)
    {
        return $solicitudDataTable->render('solicitudes.index');
    }


    public function user(SolicitudeUserDataTable $solicitudeDataTable)
    {
        return $solicitudeDataTable->render('solicitudes.index_user');
    }

    public function despacharList(SolicitudeDespachaDataTable $solicitudeDataTable)
    {
        return $solicitudeDataTable->render('solicitudes.despachar');
    }

    /**
     * Show the form for creating a new Solicitud.
     *
     * @return Response
     */
    public function create()
    {
        $temporal = $this->obtenerTemporal();

        return view('solicitudes.create',compact('temporal'));
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

        return view('solicitudes.edit')->with('solicitud', $solicitud);
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
        $solicitud = Solicitud::find($id);

        if (empty($solicitud)) {
            flash()->error('Solicitud no encontrado');

            return redirect(route('solicitudes.index'));
        }

        $this->procesar($solicitud,$request);

        flash()->success('Requisición procesada con éxito.');

        return redirect(route('solicitudes.index'));
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

    public function procesar(Solicitud $solicitud,UpdateSolicitudRequest $request){


        try {
            DB::beginTransaction();

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
//            event(new EventSolicitudCreate($solicitud));

        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        DB::commit();

        return $solicitud;
    }

    /**
     * Agrupa los detalles sumando la cantidad según el item_id
     * @param $detalles
     * @return array
     */
    public function detGroup($detalles)
    {
        $detGroup = array();

        foreach ($detalles as $det) {

            $id=$det->item_id;
            $cant=$det->cantidad;

            $detGroup[$id]= isset($detGroup[$id]) ? number_format($detGroup[$id]+$cant,2) : number_format($cant,2);

        }

        return $detGroup;
    }

    /**
     * Devuelve un array con los items los cuales no alcanza el stock según la suma de las cantidades de los detalles
     * @param array $detalles
     * @return array
     */
    public function validaStock($detalles=array()){

        $itemStockInsuficiente=array();

        foreach ($this->detGroup($detalles) as $itemId => $cant){
            $item = Item::find($itemId);

//            dump('stock: '.$item->stock.' cant: '.$cant);
            if($item->stocks->sum('cantidad')<$cant){
                $itemStockInsuficiente[]=$item;
            }
        }

        return $itemStockInsuficiente;
    }

    public function despachar(Solicitud $solicitud)
    {


        try {
            DB::beginTransaction();


            $this->procesaStock($solicitud);

            $solicitud->estado_id = SolicitudEstado::DESPACHADA;
            $solicitud->user_despacha = auth()->user()->id;
            $solicitud->tienda_despacha = session('tienda');
            $solicitud->fecha_despacha = fechaHoraActualDb();
            $solicitud->save();

            $this->verificaStock($solicitud);

            Mail::send(new DespacharSolicitud($solicitud));


        } catch (Exception $exception) {
            DB::rollBack();

            if (auth()->user()->isDev()){
                throw new Exception($exception);
            }

            flash('Error al procesar intente de nuevo!')->error()->important();

            return redirect(route('solicitudes.despachar'));
        }


        DB::commit();

        flash('Solicitud despachada correctamanete')->success()->important();

        return redirect(route('solicitudes.despachar'));
    }

    public function procesaStock(Solicitud $solicitud)
    {
        $tiendaDespacha = Tienda::find(session('tienda'));
        $tiendaSolicita = $solicitud->tiendaSolicita;

        $stock = new Stock();
        foreach ($solicitud->detalles as $detalle){
            $stock = $stock->egresoSolicitud($detalle->item_id,$detalle->cantidad,$detalle->id,$tiendaDespacha->id);

            $detalle->kardex()->create([
                'tienda_id' => $tiendaDespacha->id,
                'item_id' => $detalle->item_id,
                'cantidad' => $detalle->cantidad,
                'tipo' => Kardex::TIPO_SALIDA,
                'codigo' => $solicitud->codigo,
                'responsable' => $tiendaSolicita->nombre,
                'user_id' => auth()->user()->id
            ]);
        }

        foreach ($solicitud->detalles as $detalle){
            $stock->ingresoSolicitud($detalle->item_id,$detalle->cantidad,$detalle->id,null,null,$tiendaSolicita->id);

            $detalle->kardex()->create([
                'tienda_id' => $tiendaSolicita->id,
                'item_id' => $detalle->item_id,
                'cantidad' => $detalle->cantidad,
                'tipo' => Kardex::TIPO_INGRESO,
                'codigo' => $solicitud->codigo,
                'responsable' => $tiendaDespacha->nombre,
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function verificaStock(Solicitud $solicitud)
    {
        $itemStockCritico= collect();
        foreach ($solicitud->detalles()->with('item')->get() as $detalle){
            if($detalle->item->stockTienda()<=$detalle->item->stockCriticoTienda()){
                $itemStockCritico->push($detalle->item);
            }
        }

        if ($itemStockCritico->count()>0){
            Mail::send(new StockCriticoPorSolicitudMail($itemStockCritico,$solicitud));
        }
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

}
