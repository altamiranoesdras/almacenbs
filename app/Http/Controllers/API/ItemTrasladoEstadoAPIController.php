<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateItemTrasladoEstadoAPIRequest;
use App\Http\Requests\API\UpdateItemTrasladoEstadoAPIRequest;
use App\Models\ItemTrasladoEstado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ItemTrasladoEstadoController
 * @package App\Http\Controllers\API
 */

class ItemTrasladoEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ItemTrasladoEstado.
     * GET|HEAD /itemTrasladoEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ItemTrasladoEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $itemTrasladoEstados = $query->get();

        return $this->sendResponse($itemTrasladoEstados->toArray(), 'Item Traslado Estados retrieved successfully');
    }

    /**
     * Store a newly created ItemTrasladoEstado in storage.
     * POST /itemTrasladoEstados
     *
     * @param CreateItemTrasladoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemTrasladoEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::create($input);

        return $this->sendResponse($itemTrasladoEstado->toArray(), 'Item Traslado Estado guardado exitosamente');
    }

    /**
     * Display the specified ItemTrasladoEstado.
     * GET|HEAD /itemTrasladoEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::find($id);

        if (empty($itemTrasladoEstado)) {
            return $this->sendError('Item Traslado Estado no encontrado');
        }

        return $this->sendResponse($itemTrasladoEstado->toArray(), 'Item Traslado Estado retrieved successfully');
    }

    /**
     * Update the specified ItemTrasladoEstado in storage.
     * PUT/PATCH /itemTrasladoEstados/{id}
     *
     * @param int $id
     * @param UpdateItemTrasladoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemTrasladoEstadoAPIRequest $request)
    {
        /** @var ItemTrasladoEstado $itemTrasladoEstado */
        $itemTrasladoEstado = ItemTrasladoEstado::find($id);

        if (empty($itemTrasladoEstado)) {
            return $this->sendError('Item Traslado Estado no encontrado');
        }

        $itemTrasladoEstado->fill($request->all());
        $itemTrasladoEstado->save();

        return $this->sendResponse($itemTrasladoEstado->toArray(), 'ItemTrasladoEstado actualizado con éxito');
    }

    /**
     * Remove the specified ItemTrasladoEstado from storage.
     * DELETE /itemTrasladoEstados/{id}
     *
     * @param int $id
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
            return $this->sendError('Item Traslado Estado no encontrado');
        }

        $itemTrasladoEstado->delete();

        return $this->sendSuccess('Item Traslado Estado deleted successfully');
    }
}
