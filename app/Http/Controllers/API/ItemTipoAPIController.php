<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateItemTipoAPIRequest;
use App\Http\Requests\API\UpdateItemTipoAPIRequest;
use App\Models\ItemTipo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ItemTipoController
 * @package App\Http\Controllers\API
 */

class ItemTipoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ItemTipo.
     * GET|HEAD /itemTipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ItemTipo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $itemTipos = $query->get();

        return $this->sendResponse($itemTipos->toArray(), 'Item Tipos retrieved successfully');
    }

    /**
     * Store a newly created ItemTipo in storage.
     * POST /itemTipos
     *
     * @param CreateItemTipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::create($input);

        return $this->sendResponse($itemTipo->toArray(), 'Item Tipo guardado exitosamente');
    }

    /**
     * Display the specified ItemTipo.
     * GET|HEAD /itemTipos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::find($id);

        if (empty($itemTipo)) {
            return $this->sendError('Item Tipo no encontrado');
        }

        return $this->sendResponse($itemTipo->toArray(), 'Item Tipo retrieved successfully');
    }

    /**
     * Update the specified ItemTipo in storage.
     * PUT/PATCH /itemTipos/{id}
     *
     * @param int $id
     * @param UpdateItemTipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemTipoAPIRequest $request)
    {
        /** @var ItemTipo $itemTipo */
        $itemTipo = ItemTipo::find($id);

        if (empty($itemTipo)) {
            return $this->sendError('Item Tipo no encontrado');
        }

        $itemTipo->fill($request->all());
        $itemTipo->save();

        return $this->sendResponse($itemTipo->toArray(), 'ItemTipo actualizado con éxito');
    }

    /**
     * Remove the specified ItemTipo from storage.
     * DELETE /itemTipos/{id}
     *
     * @param int $id
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
            return $this->sendError('Item Tipo no encontrado');
        }

        $itemTipo->delete();

        return $this->sendSuccess('Item Tipo deleted successfully');
    }
}
