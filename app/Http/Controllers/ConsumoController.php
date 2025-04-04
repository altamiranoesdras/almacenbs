<?php

namespace App\Http\Controllers;

use App\DataTables\ConsumoDataTable;
use App\DataTables\ConsumoUserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConsumoRequest;
use App\Http\Requests\UpdateConsumoRequest;
use App\Models\Bodega;
use App\Models\Consumo;
use App\Models\ConsumoEstado;
use App\Models\ConsumoDetalle;
use App\Models\Item;
use App\Models\RrhhUnidad;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Exception;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Response;

class ConsumoController extends AppBaseController
{

    public function __construct()
    {
//        $this->middleware('permission:Ver Consumos')->only(['show']);
//        $this->middleware('permission:Crear Consumos')->only(['create','store']);
//        $this->middleware('permission:Editar Consumos')->only(['edit','update',]);
//        $this->middleware('permission:Eliminar Consumos')->only(['destroy']);
    }

    /**
     * Display a listing of the Consumo.
     *
     * @param ConsumoDataTable $consumoDataTable
     * @return Response
     */
    public function index(ConsumoDataTable $consumoDataTable)
    {
        return $consumoDataTable->render('consumos.index');
    }

    public function user(ConsumoUserDataTable $solicitudDataTable)
    {

//        $item = Item::where('codigo_presentacion',32153)->get();
//
//        return $item;


        return $solicitudDataTable->render('consumos.usuario.index');
    }

    /**
     * Show the form for creating a new Consumo.
     *
     * @return Response
     */
    public function create()
    {

        $consumo = $this->obtenerTemporal();

        return view('consumos.create',compact('consumo'));
    }

    /**
     * Store a newly created Consumo in storage.
     *
     * @param CreateConsumoRequest $request
     *
     * @return Response
     */
    public function store(CreateConsumoRequest $request)
    {
        $input = $request->all();

        /** @var Consumo $consumo */
        $consumo = Consumo::create($input);

        Flash::success('Consumo guardado exitosamente.');

        return redirect(route('consumos.index'));
    }

    /**
     * Display the specified Consumo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        return view('consumos.show')->with('consumo', $consumo);
    }

    /**
     * Show the form for editing the specified Consumo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        return view('consumos.create')->with('consumo', $consumo);
    }

    /**
     * Update the specified Consumo in storage.
     *
     * @param  int              $id
     * @param UpdateConsumoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConsumoRequest $request)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }


        $request->merge([
            'usuario_crea' => auth()->user()->id,
            'unidad_id' => auth()->user()->unidad_id,
            'bodega_id' => auth()->user()->bodega_id,
            'estado_id' => ConsumoEstado::INGRESADO,
        ]);


        $consumo->fill($request->all());
        $consumo->save();


        if ($request->procesar){

            $errores = $this->validaStock($consumo);

            if (count($errores) > 0){
                return redirect(route('consumos.edit',$consumo->id) )->withInput()->withErrors($errores);
            }


            try {
                DB::beginTransaction();


                $this->procesar($consumo,$request);


            } catch (Exception $exception) {
                DB::rollBack();

                throw new Exception($exception);
            }

            DB::commit();



            flash()->success('Consumo procesado!.');

            return redirect(route('consumos.usuario'));

        }

        flash()->success('Consumo guardado exitosamente.');

        return redirect(route('consumos.edit',$consumo->id));

    }

    public function procesar(consumo $consumo,UpdateconsumoRequest $request){



        $request->merge([
            'codigo' => $this->getCodigo(),
            'correlativo' => $this->getCorrelativo(),
            'estado_id' => ConsumoEstado::PROCESADO,
            'fecha_procesa' => Carbon::now(),
        ]);


        $consumo->fill($request->all());
        $consumo->save();

        $consumo->egreso();


        return $consumo;

    }

    /**
     * Remove the specified Consumo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        $consumo->delete();

        Flash::success('Consumo deleted successfully.');

        return redirect(route('consumos.index'));
    }


    public function obtenerTemporal()
    {

        $user = auth()->user();

        $compra = Consumo::temporal()->delUsuarioCrea()->first();


        if (!$compra){

            $compra =  Consumo::create([
                'usuario_crea' => $user->id,
                'estado_id' => ConsumoEstado::TEMPORAL,
            ]);
        }

        return $compra;
    }

    public function cancelar(Consumo $consumo){

        $consumo->detalles()->delete();
        $consumo->delete();

        flash()->success('Listo! consumo cancelada.');

        return redirect(route('consumos.create'));
    }

    public function anular(Consumo $consumo){

        try {
            DB::beginTransaction();

            $consumo->anular();

        } catch (Exception $exception) {
            DB::rollBack();

            errorException($exception);
        }

        DB::commit();


        flash()->success('Listo! consumo anulada.');

        return redirect(route('consumos.index'));
    }


    public function validaStock(Consumo $consumo){

        $errores=array();


        /**
         * @var ConsumoDetalle $detalle
         */
        foreach ($consumo->detalles as $index => $detalle) {

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
        return "CMO-".prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = Consumo::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }


    /**
     * Genera pdf con usando libreria DOMPDF
     * @param Consumo $consumo
     * @return mixed
     */
    public function pdf(Consumo $consumo)
    {


        /**
         * @var PDF $pdf
         */
        $pdf = App::make('dompdf.wrapper');

        $vita = view('consumos.pdf',compact('consumo'))->render();


        return $pdf->loadHTML($vita)
            ->setPaper('letter','portrait')
            ->stream("consumo_".$consumo->codigo.".pdf");

    }
}
