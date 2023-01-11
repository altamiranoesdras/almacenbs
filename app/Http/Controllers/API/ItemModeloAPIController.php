<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateItemModeloAPIRequest;
use App\Http\Requests\API\UpdateItemModeloAPIRequest;
use App\Models\ItemModelo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ItemModeloController
 * @package App\Http\Controllers\API
 */

class ItemModeloAPIController extends AppBaseController
{
    /**
     * Display a listing of the ItemModelo.
     * GET|HEAD /itemModelos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ItemModelo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $itemModelos = $query->get();

        return $this->sendResponse($itemModelos->toArray(), 'Item Modelos retrieved successfully');
    }

    /**
     * Store a newly created ItemModelo in storage.
     * POST /itemModelos
     *
     * @param CreateItemModeloAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemModeloAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::create($input);

        return $this->sendResponse($itemModelo->toArray(), 'Item Modelo guardado exitosamente');
    }

    /**
     * Display the specified ItemModelo.
     * GET|HEAD /itemModelos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::find($id);

        if (empty($itemModelo)) {
            return $this->sendError('Item Modelo no encontrado');
        }

        return $this->sendResponse($itemModelo->toArray(), 'Item Modelo retrieved successfully');
    }

    /**
     * Update the specified ItemModelo in storage.
     * PUT/PATCH /itemModelos/{id}
     *
     * @param int $id
     * @param UpdateItemModeloAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemModeloAPIRequest $request)
    {
        /** @var ItemModelo $itemModelo */
        $itemModelo = ItemModelo::find($id);

        if (empty($itemModelo)) {
            return $this->sendError('Item Modelo no encontrado');
        }

        $itemModelo->fill($request->all());
        $itemModelo->save();

        return $this->sendResponse($itemModelo->toArray(), 'ItemModelo actualizado con éxito');
    }

    /**
     * Remove the specified ItemModelo from storage.
     * DELETE /itemModelos/{id}
     *
     * @param int $id
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
            return $this->sendError('Item Modelo no encontrado');
        }

        $itemModelo->delete();

        return $this->sendSuccess('Item Modelo deleted successfully');
    }
}
