<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRedProduccionProductoAPIRequest;
use App\Http\Requests\API\UpdateRedProduccionProductoAPIRequest;
use App\Models\RedProduccionProducto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RedProduccionProductoAPIController
 */
class RedProduccionProductoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RedProduccionProductos.
     * GET|HEAD /red-produccion-productos
     */
    public function index(Request $request): JsonResponse
    {
        $query = RedProduccionProducto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $redProduccionProductos = $query->get();

        return $this->sendResponse($redProduccionProductos->toArray(), 'Red Produccion Productos ');
    }

    /**
     * Store a newly created RedProduccionProducto in storage.
     * POST /red-produccion-productos
     */
    public function store(CreateRedProduccionProductoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::create($input);

        return $this->sendResponse($redProduccionProducto->toArray(), 'Red Produccion Producto guardado');
    }

    /**
     * Display the specified RedProduccionProducto.
     * GET|HEAD /red-produccion-productos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            return $this->sendError('Red Produccion Producto no encontrado');
        }

        return $this->sendResponse($redProduccionProducto->toArray(), 'Red Produccion Producto ');
    }

    /**
     * Update the specified RedProduccionProducto in storage.
     * PUT/PATCH /red-produccion-productos/{id}
     */
    public function update($id, UpdateRedProduccionProductoAPIRequest $request): JsonResponse
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            return $this->sendError('Red Produccion Producto no encontrado');
        }

        $redProduccionProducto->fill($request->all());
        $redProduccionProducto->save();

        return $this->sendResponse($redProduccionProducto->toArray(), 'RedProduccionProducto actualizado');
    }

    /**
     * Remove the specified RedProduccionProducto from storage.
     * DELETE /red-produccion-productos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            return $this->sendError('Red Produccion Producto no encontrado');
        }

        $redProduccionProducto->delete();

        return $this->sendSuccess('Red Produccion Producto eliminado');
    }
}
