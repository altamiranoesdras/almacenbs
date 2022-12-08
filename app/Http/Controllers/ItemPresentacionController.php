<?php

namespace App\Http\Controllers;

use App\DataTables\ItemPresentacionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemPresentacionRequest;
use App\Http\Requests\UpdateItemPresentacionRequest;
use App\Models\ItemPresentacion;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemPresentacionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Item Presentaciones')->only(['show']);
        $this->middleware('permission:Crear Item Presentaciones')->only(['create','store']);
        $this->middleware('permission:Editar Item Presentaciones')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Item Presentaciones')->only(['destroy']);
    }

    /**
     * Display a listing of the ItemPresentacion.
     *
     * @param ItemPresentacionDataTable $itemPresentacionDataTable
     * @return Response
     */
    public function index(ItemPresentacionDataTable $itemPresentacionDataTable)
    {
        return $itemPresentacionDataTable->render('item_presentaciones.index');
    }

    /**
     * Show the form for creating a new ItemPresentacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_presentaciones.create');
    }

    /**
     * Store a newly created ItemPresentacion in storage.
     *
     * @param CreateItemPresentacionRequest $request
     *
     * @return Response
     */
    public function store(CreateItemPresentacionRequest $request)
    {
        $input = $request->all();

        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::create($input);

        Flash::success('Item Presentacion guardado exitosamente.');

        return redirect(route('itemPresentaciones.index'));
    }

    /**
     * Display the specified ItemPresentacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::find($id);

        if (empty($itemPresentacion)) {
            Flash::error('Item Presentacion no encontrado');

            return redirect(route('itemPresentaciones.index'));
        }

        return view('item_presentaciones.show')->with('itemPresentacion', $itemPresentacion);
    }

    /**
     * Show the form for editing the specified ItemPresentacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::find($id);

        if (empty($itemPresentacion)) {
            Flash::error('Item Presentacion no encontrado');

            return redirect(route('itemPresentaciones.index'));
        }

        return view('item_presentaciones.edit')->with('itemPresentacion', $itemPresentacion);
    }

    /**
     * Update the specified ItemPresentacion in storage.
     *
     * @param  int              $id
     * @param UpdateItemPresentacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemPresentacionRequest $request)
    {
        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::find($id);

        if (empty($itemPresentacion)) {
            Flash::error('Item Presentacion no encontrado');

            return redirect(route('itemPresentaciones.index'));
        }

        $itemPresentacion->fill($request->all());
        $itemPresentacion->save();

        Flash::success('Item Presentacion actualizado con éxito.');

        return redirect(route('itemPresentaciones.index'));
    }

    /**
     * Remove the specified ItemPresentacion from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::find($id);

        if (empty($itemPresentacion)) {
            Flash::error('Item Presentacion no encontrado');

            return redirect(route('itemPresentaciones.index'));
        }

        $itemPresentacion->delete();

        Flash::success('Item Presentacion deleted successfully.');

        return redirect(route('itemPresentaciones.index'));
    }
}
