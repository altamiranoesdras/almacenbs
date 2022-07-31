<?php

namespace App\Http\Controllers;

use App\DataTables\ItemDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\User;
use App\Traits\ItemTrait;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;

class ItemController extends AppBaseController
{
    use ItemTrait;

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

        /**
         * @var User $user
         */
        $user = auth()->user();

        try {
            DB::beginTransaction();

            $this->procesarStore($request);

        } catch (\Exception $exception) {
            DB::rollBack();

            if ($user->isDev()){
                throw $exception;
            }

            $msg = $user->isAdmin() ? $exception->getMessage() : 'Hubo un error intente de nuevo';

            flash('Error: '.$msg)->error()->important();

            return redirect()->back();
        }


        DB::commit();

        flash('Item guardado exitosamente.')->success();

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
