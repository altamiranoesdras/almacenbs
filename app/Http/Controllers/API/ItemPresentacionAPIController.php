<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateItemPresentacionAPIRequest;
use App\Http\Requests\API\UpdateItemPresentacionAPIRequest;
use App\Models\ItemPresentacion;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ItemPresentacionController
 * @package App\Http\Controllers\API
 */

class ItemPresentacionAPIController extends AppBaseController
{
    /**
     * Display a listing of the ItemPresentacion.
     * GET|HEAD /itemPresentaciones
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ItemPresentacion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $itemPresentaciones = $query->get();

        return $this->sendResponse($itemPresentaciones->toArray(), 'Item Presentaciones retrieved successfully');
    }

    /**
     * Store a newly created ItemPresentacion in storage.
     * POST /itemPresentaciones
     *
     * @param CreateItemPresentacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemPresentacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::create($input);

        return $this->sendResponse($itemPresentacion->toArray(), 'Item Presentacion guardado exitosamente');
    }

    /**
     * Display the specified ItemPresentacion.
     * GET|HEAD /itemPresentaciones/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::find($id);

        if (empty($itemPresentacion)) {
            return $this->sendError('Item Presentacion no encontrado');
        }

        return $this->sendResponse($itemPresentacion->toArray(), 'Item Presentacion retrieved successfully');
    }

    /**
     * Update the specified ItemPresentacion in storage.
     * PUT/PATCH /itemPresentaciones/{id}
     *
     * @param int $id
     * @param UpdateItemPresentacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemPresentacionAPIRequest $request)
    {
        /** @var ItemPresentacion $itemPresentacion */
        $itemPresentacion = ItemPresentacion::find($id);

        if (empty($itemPresentacion)) {
            return $this->sendError('Item Presentacion no encontrado');
        }

        $itemPresentacion->fill($request->all());
        $itemPresentacion->save();

        return $this->sendResponse($itemPresentacion->toArray(), 'ItemPresentacion actualizado con éxito');
    }

    /**
     * Remove the specified ItemPresentacion from storage.
     * DELETE /itemPresentaciones/{id}
     *
     * @param int $id
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
            return $this->sendError('Item Presentacion no encontrado');
        }

        $itemPresentacion->delete();

        return $this->sendSuccess('Item Presentacion deleted successfully');
    }
}
