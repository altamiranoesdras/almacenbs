<?php

namespace App\Http\Controllers;

use App\DataTables\ItemTrasladoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemTrasladoRequest;
use App\Http\Requests\UpdateItemTrasladoRequest;
use App\Models\ItemTraslado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemTrasladoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Item Traslados')->only(['show']);
        $this->middleware('permission:Crear Item Traslados')->only(['create','store']);
        $this->middleware('permission:Editar Item Traslados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Item Traslados')->only(['destroy']);
    }

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
        $input = $request->all();

        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::create($input);

        Flash::success('Item Traslado guardado exitosamente.');

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
            Flash::error('Item Traslado no encontrado');

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
            Flash::error('Item Traslado no encontrado');

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
            Flash::error('Item Traslado no encontrado');

            return redirect(route('itemTraslados.index'));
        }

        $itemTraslado->fill($request->all());
        $itemTraslado->save();

        Flash::success('Item Traslado actualizado con éxito.');

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
            Flash::error('Item Traslado no encontrado');

            return redirect(route('itemTraslados.index'));
        }

        $itemTraslado->delete();

        Flash::success('Item Traslado deleted successfully.');

        return redirect(route('itemTraslados.index'));
    }
}
