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
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

        Flash::success('Solicitud guardado exitosamente.');

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
            Flash::error('Solicitud no encontrado');

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
            Flash::error('Solicitud no encontrado');

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
            Flash::error('Solicitud no encontrado');

            return redirect(route('solicitudes.index'));
        }

        $solicitud->fill($request->all());
        $solicitud->save();

        Flash::success('Solicitud actualizado con éxito.');

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
            Flash::error('Solicitud no encontrado');

            return redirect(route('solicitudes.index'));
        }

        $solicitud->delete();

        Flash::success('Solicitud deleted successfully.');

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

    public function cancelar(TempSolicitude $tempSolicitude){

        $tempSolicitude->tempSolicitudDetalles()->delete();
        $tempSolicitude->delete();

        Flash::success('Listo! solicitud cancelada.');

        return redirect(route('solicitudes.create'));
    }

    public function procesar(TempSolicitude $tempSolicitude,UpdateSolicitudRequest $request){


        try {
            DB::connection('tenant')->beginTransaction();

            $correlativo = Correlativo::siguiente('solicitudes');

            $request->merge(['correlativo' => $correlativo->max]);
            $request->merge(['user_solicita' => auth()->user()->id]);
            $request->merge(['tienda_solicita' => session('tienda')]);
            $request->merge(['fecha_solicita' => hoyDb()]);
            $request->merge(['estado_id' => SolicitudEstado::SOLICITADA]);

//            dd($request->all(),$tempSolicitude->detalles->toArray());

            //Guarda el encabezado de la Solicitud
            $solicitud = Solicitude::create($request->all());

            //Crea colección de objetos en base a detalles temporales
            $detalles = $tempSolicitude->detalles->map(function ($item) {
                return new SolicitudDetalle($item->toArray());
            });

            //Guarda los detalles de la Solicitud
            $solicitud->detalles()->saveMany($detalles);


            //Cambia el estado de la Solicitud temporal
            $tempSolicitude->detalles()->delete();
            $tempSolicitude->delete();
            $correlativo->save();

            Mail::send(new SolicitudStock($solicitud));
            event(new EventSolicitudCreate($solicitud));

        } catch (Exception $exception) {
            DB::connection('tenant')->rollBack();

            throw new Exception($exception);
        }

        DB::connection('tenant')->commit();

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
            DB::connection('tenant')->beginTransaction();


            $this->procesaStock($solicitud);

            $solicitud->estado_id = SolicitudEstado::DESPACHADA;
            $solicitud->user_despacha = auth()->user()->id;
            $solicitud->tienda_despacha = session('tienda');
            $solicitud->fecha_despacha = fechaHoraActualDb();
            $solicitud->save();

            $this->verificaStock($solicitud);

            Mail::send(new DespacharSolicitud($solicitud));


        } catch (Exception $exception) {
            DB::connection('tenant')->rollBack();

            if (auth()->user()->isDev()){
                throw new Exception($exception);
            }

            flash('Error al procesar intente de nuevo!')->error()->important();

            return redirect(route('solicitudes.despachar'));
        }


        DB::connection('tenant')->commit();

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
}
