<?php

namespace App\Http\Controllers;

use App\DataTables\ItemModeloDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemModeloRequest;
use App\Http\Requests\UpdateItemModeloRequest;
use App\Models\ItemModelo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemModeloController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Item Modelos')->only(['show']);
        $this->middleware('permission:Crear Item Modelos')->only(['create','store']);
        $this->middleware('permission:Editar Item Modelos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Item Modelos')->only(['destroy']);
    }

    /**
     * Display a listing of the ItemModelo.
     *
     * @param ItemModeloDataTable $itemModeloDataTable
     * @return Response
     */
    public function index(ItemModeloDataTable $itemModeloDataTable)
    {
        return $itemModeloDataTable->render('item_modelos.index');
    }

    /**
     * Show the form for creating a new ItemModelo.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_modelos.create');
    }

    /**
     * Store a newly created ItemModelo in storage.
     *
     * @param CreateItemModeloRequest $request
     *
     * @return Response
     */
    public function store(CreateItemModeloRequest $request)
    {
        $input = $request->all();

        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::create($input);

        Flash::success('Item Modelo guardado exitosamente.');

        return redirect(route('itemModelos.index'));
    }

    /**
     * Display the specified ItemModelo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::find($id);

        if (empty($itemModelo)) {
            Flash::error('Item Modelo no encontrado');

            return redirect(route('itemModelos.index'));
        }

        return view('item_modelos.show')->with('itemModelo', $itemModelo);
    }

    /**
     * Show the form for editing the specified ItemModelo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::find($id);

        if (empty($itemModelo)) {
            Flash::error('Item Modelo no encontrado');

            return redirect(route('itemModelos.index'));
        }

        return view('item_modelos.edit')->with('itemModelo', $itemModelo);
    }

    /**
     * Update the specified ItemModelo in storage.
     *
     * @param  int              $id
     * @param UpdateItemModeloRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemModeloRequest $request)
    {
        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::find($id);

        if (empty($itemModelo)) {
            Flash::error('Item Modelo no encontrado');

            return redirect(route('itemModelos.index'));
        }

        $itemModelo->fill($request->all());
        $itemModelo->save();

        Flash::success('Item Modelo actualizado con éxito.');

        return redirect(route('itemModelos.index'));
    }

    /**
     * Remove the specified ItemModelo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::find($id);

        if (empty($itemModelo)) {
            Flash::error('Item Modelo no encontrado');

            return redirect(route('itemModelos.index'));
        }

        $itemModelo->delete();

        Flash::success('Item Modelo deleted successfully.');

        return redirect(route('itemModelos.index'));
    }
}
