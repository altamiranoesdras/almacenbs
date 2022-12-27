<?php

namespace App\Http\Controllers;

use App\DataTables\ConsumoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConsumoRequest;
use App\Http\Requests\UpdateConsumoRequest;
use App\Models\Consumo;
use App\Models\ConsumoEstado;
use App\Models\ConsumoDetalle;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;

class ConsumoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Consumos')->only(['show']);
        $this->middleware('permission:Crear Consumos')->only(['create','store']);
        $this->middleware('permission:Editar Consumos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Consumos')->only(['destroy']);
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

        return view('consumos.edit')->with('consumo', $consumo);
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

        $consumo->fill($request->all());
        $consumo->save();

        Flash::success('Consumo actualizado con éxito.');

        return redirect(route('consumos.index'));
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

        return redirect(route('consumoes.create'));
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

        return redirect(route('consumoes.index'));
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
}
