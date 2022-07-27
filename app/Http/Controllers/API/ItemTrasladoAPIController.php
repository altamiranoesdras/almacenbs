<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateItemTrasladoAPIRequest;
use App\Http\Requests\API\UpdateItemTrasladoAPIRequest;
use App\Models\ItemTraslado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ItemTrasladoController
 * @package App\Http\Controllers\API
 */

class ItemTrasladoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ItemTraslado.
     * GET|HEAD /itemTraslados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ItemTraslado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $itemTraslados = $query->get();

        return $this->sendResponse($itemTraslados->toArray(), 'Item Traslados retrieved successfully');
    }

    /**
     * Store a newly created ItemTraslado in storage.
     * POST /itemTraslados
     *
     * @param CreateItemTrasladoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemTrasladoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::create($input);

        return $this->sendResponse($itemTraslado->toArray(), 'Item Traslado guardado exitosamente');
    }

    /**
     * Display the specified ItemTraslado.
     * GET|HEAD /itemTraslados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::find($id);

        if (empty($itemTraslado)) {
            return $this->sendError('Item Traslado no encontrado');
        }

        return $this->sendResponse($itemTraslado->toArray(), 'Item Traslado retrieved successfully');
    }

    /**
     * Update the specified ItemTraslado in storage.
     * PUT/PATCH /itemTraslados/{id}
     *
     * @param int $id
     * @param UpdateItemTrasladoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemTrasladoAPIRequest $request)
    {
        /** @var ItemTraslado $itemTraslado */
        $itemTraslado = ItemTraslado::find($id);

        if (empty($itemTraslado)) {
            return $this->sendError('Item Traslado no encontrado');
        }

        $itemTraslado->fill($request->all());
        $itemTraslado->save();

        return $this->sendResponse($itemTraslado->toArray(), 'ItemTraslado actualizado con éxito');
    }

    /**
     * Remove the specified ItemTraslado from storage.
     * DELETE /itemTraslados/{id}
     *
     * @param int $id
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
            return $this->sendError('Item Traslado no encontrado');
        }

        $itemTraslado->delete();

        return $this->sendSuccess('Item Traslado deleted successfully');
    }
}
