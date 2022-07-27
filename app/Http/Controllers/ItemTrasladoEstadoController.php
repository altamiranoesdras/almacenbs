<?php

namespace App\Http\Controllers;

use App\DataTables\ItemTrasladoEstadoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemTrasladoEstadoRequest;
use App\Http\Requests\UpdateItemTrasladoEstadoRequest;
use App\Models\ItemTrasladoEstado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemTrasladoEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Item Traslado Estados')->only(['show']);
        $this->middleware('permission:Crear Item Traslado Estados')->only(['create','store']);
        $this->middleware('permission:Editar Item Traslado Estados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Item Traslado Estados')->only(['destroy']);
    }

    /**
     * Display a listing of the ItemTrasladoEstado.
     *
     * @param ItemTrasladoEstadoDataTable $itemTrasladoEstadoDataTable
     * @return Response
     */
    public function index(ItemTrasladoEstadoDataTable $itemTrasladoEstadoDataTable)
    {
        return $itemTrasladoEstadoDataTable->render('item_traslado_estados.index');
    }

    /**
     * Show the form for creating a new ItemTrasladoEstado.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_traslado_estados.create');
    }

    /**
     * Store a newly created ItemTrasladoEstado in storage.
     *
     * @param CreateItemTrasladoEstadoRequest $request
     *
     * @return Response
     */
    public function store(CreateItemTrasladoEstadoRequest $request)
    {
        $input = $request->all();

        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::create($input);

        Flash::success('Item Traslado Estado guardado exitosamente.');

        return redirect(route('itemTrasladoEstados.index'));
    }

    /**
     * Display the specified ItemTrasladoEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::find($id);

        if (empty($itemTrasladoEstado)) {
            Flash::error('Item Traslado Estado no encontrado');

            return redirect(route('itemTrasladoEstados.index'));
        }

        return view('item_traslado_estados.show')->with('itemTrasladoEstado', $itemTrasladoEstado);
    }

    /**
     * Show the form for editing the specified ItemTrasladoEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::find($id);

        if (empty($itemTrasladoEstado)) {
            Flash::error('Item Traslado Estado no encontrado');

            return redirect(route('itemTrasladoEstados.index'));
        }

        return view('item_traslado_estados.edit')->with('itemTrasladoEstado', $itemTrasladoEstado);
    }

    /**
     * Update the specified ItemTrasladoEstado in storage.
     *
     * @param  int              $id
     * @param UpdateItemTrasladoEstadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemTrasladoEstadoRequest $request)
    {
        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::find($id);

        if (empty($itemTrasladoEstado)) {
            Flash::error('Item Traslado Estado no encontrado');

            return redirect(route('itemTrasladoEstados.index'));
        }

        $itemTrasladoEstado->fill($request->all());
        $itemTrasladoEstado->save();

        Flash::success('Item Traslado Estado actualizado con éxito.');

        return redirect(route('itemTrasladoEstados.index'));
    }

    /**
     * Remove the specified ItemTrasladoEstado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::find($id);

        if (empty($itemTrasladoEstado)) {
            Flash::error('Item Traslado Estado no encontrado');

            return redirect(route('itemTrasladoEstados.index'));
        }

        $itemTrasladoEstado->delete();

        Flash::success('Item Traslado Estado deleted successfully.');

        return redirect(route('itemTrasladoEstados.index'));
    }
}
