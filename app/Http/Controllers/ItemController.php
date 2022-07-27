<?php

namespace App\Http\Controllers;

use App\DataTables\ItemDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Items')->only(['show']);
        $this->middleware('permission:Crear Items')->only(['create','store']);
        $this->middleware('permission:Editar Items')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Items')->only(['destroy']);
    }

    /**
     * Display a listing of the Item.
     *
     * @param ItemDataTable $itemDataTable
     * @return Response
     */
    public function index(ItemDataTable $itemDataTable)
    {
        return $itemDataTable->render('items.index');
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return Response
     */
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();

        /** @var Item $item */
        $item = Item::create($input);

        Flash::success('Item guardado exitosamente.');

        return redirect(route('items.index'));
    }

    /**
     * Display the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item no encontrado');

            return redirect(route('items.index'));
        }

        return view('items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item no encontrado');

            return redirect(route('items.index'));
        }

        return view('items.edit')->with('item', $item);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param  int              $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemRequest $request)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item no encontrado');

            return redirect(route('items.index'));
        }

        $item->fill($request->all());
        $item->save();

        Flash::success('Item actualizado con éxito.');

        return redirect(route('items.index'));
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Item $item */
        $item = Item::find($id);

        if (empty($item)) {
            Flash::error('Item no encontrado');

            return redirect(route('items.index'));
        }

        $item->delete();

        Flash::success('Item deleted successfully.');

        return redirect(route('items.index'));
    }
}
