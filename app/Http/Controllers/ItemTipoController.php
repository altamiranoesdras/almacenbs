<?php

namespace App\Http\Controllers;

use App\DataTables\ItemTipoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemTipoRequest;
use App\Http\Requests\UpdateItemTipoRequest;
use App\Models\ItemTipo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Item Tipos')->only(['show']);
        $this->middleware('permission:Crear Item Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Item Tipos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Item Tipos')->only(['destroy']);
    }

    /**
     * Display a listing of the ItemTipo.
     *
     * @param ItemTipoDataTable $itemTipoDataTable
     * @return Response
     */
    public function index(ItemTipoDataTable $itemTipoDataTable)
    {
        return $itemTipoDataTable->render('item_tipos.index');
    }

    /**
     * Show the form for creating a new ItemTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_tipos.create');
    }

    /**
     * Store a newly created ItemTipo in storage.
     *
     * @param CreateItemTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateItemTipoRequest $request)
    {
        $input = $request->all();

        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::create($input);

        Flash::success('Item Tipo guardado exitosamente.');

        return redirect(route('itemTipos.index'));
    }

    /**
     * Display the specified ItemTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::find($id);

        if (empty($itemTipo)) {
            Flash::error('Item Tipo no encontrado');

            return redirect(route('itemTipos.index'));
        }

        return view('item_tipos.show')->with('itemTipo', $itemTipo);
    }

    /**
     * Show the form for editing the specified ItemTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::find($id);

        if (empty($itemTipo)) {
            Flash::error('Item Tipo no encontrado');

            return redirect(route('itemTipos.index'));
        }

        return view('item_tipos.edit')->with('itemTipo', $itemTipo);
    }

    /**
     * Update the specified ItemTipo in storage.
     *
     * @param  int              $id
     * @param UpdateItemTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemTipoRequest $request)
    {
        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::find($id);

        if (empty($itemTipo)) {
            Flash::error('Item Tipo no encontrado');

            return redirect(route('itemTipos.index'));
        }

        $itemTipo->fill($request->all());
        $itemTipo->save();

        Flash::success('Item Tipo actualizado con éxito.');

        return redirect(route('itemTipos.index'));
    }

    /**
     * Remove the specified ItemTipo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::find($id);

        if (empty($itemTipo)) {
            Flash::error('Item Tipo no encontrado');

            return redirect(route('itemTipos.index'));
        }

        $itemTipo->delete();

        Flash::success('Item Tipo deleted successfully.');

        return redirect(route('itemTipos.index'));
    }
}
