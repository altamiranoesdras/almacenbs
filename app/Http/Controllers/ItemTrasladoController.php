<?php

namespace App\Http\Controllers;

use App\DataTables\ItemTrasladoDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateItemTrasladoRequest;
use App\Http\Requests\UpdateItemTrasladoRequest;
use App\Models\Equivalencia;
use App\Models\Item;
use App\Models\ItemTraslado;
use App\Models\ItemTrasladoEstado;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ItemTrasladoController extends AppBaseController
{
    /**
     * Display a listing of the ItemTraslado.
     *
     * @param ItemTrasladoDataTable $itemTrasladoDataTable
     * @return Response
     */
    public function index(ItemTrasladoDataTable $itemTrasladoDataTable)
    {
        return $itemTrasladoDataTable->render('item_traslados.index');
    }

    /**
     * Show the form for creating a new ItemTraslado.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_traslados.create');
    }

    /**
     * Store a newly created ItemTraslado in storage.
     *
     * @param CreateItemTrasladoRequest $request
     *
     * @return Response
     */
    public function store(CreateItemTrasladoRequest $request)
    {

        $request->merge([
            'codigo' => $this->getCodigo(),
            'correlativo' => $this->getCorrelativo(),
            'user_id' => auth()->user()->id,
            'estado_id' => 1,
        ]);


        try {
            DB::beginTransaction();

            /** @var ItemTraslado $itemTraslado */
            $itemTraslado = ItemTraslado::create($request->all());

            $itemTraslado->procesarEgreso();
            $itemTraslado->procesarIngreso();

            $this->registraEquivalencia($request);

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();


        flash()->success('Item Traslado Guardado exitosamente.');

        return redirect(route('itemTraslados.index'));
    }

    /**
     * Display the specified ItemTraslado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::find($id);

        if (empty($itemTraslado)) {
            flash()->error('Item Traslado not found');

            return redirect(route('itemTraslados.index'));
        }

        return view('item_traslados.show')->with('itemTraslado', $itemTraslado);
    }

    /**
     * Show the form for editing the specified ItemTraslado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::find($id);

        if (empty($itemTraslado)) {
            flash()->error('Item Traslado not found');

            return redirect(route('itemTraslados.index'));
        }

        return view('item_traslados.edit')->with('itemTraslado', $itemTraslado);
    }

    /**
     * Update the specified ItemTraslado in storage.
     *
     * @param  int              $id
     * @param UpdateItemTrasladoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemTrasladoRequest $request)
    {
        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::find($id);

        if (empty($itemTraslado)) {
            flash()->error('Item Traslado not found');

            return redirect(route('itemTraslados.index'));
        }

        $itemTraslado->fill($request->all());
        $itemTraslado->save();

        flash()->success('Item Traslado updated successfully.');

        return redirect(route('itemTraslados.index'));
    }

    /**
     * Remove the specified ItemTraslado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::find($id);

        if (empty($itemTraslado)) {
            flash()->error('Item Traslado not found');

            return redirect(route('itemTraslados.index'));
        }

        $itemTraslado->delete();

        flash()->success('Item Traslado deleted successfully.');

        return redirect(route('itemTraslados.index'));
    }

    public function getCodigo()
    {
        return prefijoCeros($this->getCorrelativo(),4).Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = ItemTraslado::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

    public function registraEquivalencia(Request $request)
    {
        $item_origen = $request->item_origen;
        $item_destino = $request->item_destino;

        $equivalente = $request->cantidad_destino/$request->cantidad_origen;

        $equivalencia = Equivalencia::where('item_origen',$item_origen)->where('item_destino',$item_destino)->first();

        //si no existe equivalencia registrada en la db
        if (empty($equivalencia)){

            Equivalencia::create([
                'item_origen' => $item_origen,
                'item_destino' => $item_destino,
                'cantidad' => $equivalente
            ]);
        }
        //de lo contrario modifica la equivalencia existente
        else{
            $equivalencia->item_origen = $item_origen;
            $equivalencia->item_destino = $item_destino;
            $equivalencia->cantidad = $equivalente;
            $equivalencia->save();
        }
    }

    public function anular(ItemTraslado $itemTraslado){

        try {
            DB::beginTransaction();


            $itemTraslado->anular();


        } catch (\Exception $exception) {
            DB::rollBack();

            if (Auth::user()->isDev()){
                throw new \Exception($exception);
            }

            $msg = Auth::user()->isAdmin() ? $exception->getMessage() : 'Hubo un error intente de nuevo';

            flash('Error: '.$msg)->error()->important();
            return redirect()->back();
        }


        DB::commit();


        flash()->success('Listo! traslado anulado.');

        return redirect(route('itemTraslados.index'));
    }
}
