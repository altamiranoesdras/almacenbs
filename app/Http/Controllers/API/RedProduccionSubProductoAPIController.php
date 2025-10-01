<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRedProduccionSubProductoAPIRequest;
use App\Http\Requests\API\UpdateRedProduccionSubProductoAPIRequest;
use App\Models\RedProduccionSubProducto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RedProduccionSubProductoAPIController
 */
class RedProduccionSubProductoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RedProduccionSubProductos.
     * GET|HEAD /red-produccion-sub-productos
     */
    public function index(Request $request): JsonResponse
    {
        $query = RedProduccionSubProducto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $redProduccionSubProductos = $query->get();

        return $this->sendResponse($redProduccionSubProductos->toArray(), 'Red Produccion Sub Productos ');
    }

    /**
     * Store a newly created RedProduccionSubProducto in storage.
     * POST /red-produccion-sub-productos
     */
    public function store(CreateRedProduccionSubProductoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::create($input);

        return $this->sendResponse($redProduccionSubProducto->toArray(), 'Red Produccion Sub Producto guardado');
    }

    /**
     * Display the specified RedProduccionSubProducto.
     * GET|HEAD /red-produccion-sub-productos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            return $this->sendError('Red Produccion Sub Producto no encontrado');
        }

        return $this->sendResponse($redProduccionSubProducto->toArray(), 'Red Produccion Sub Producto ');
    }

    /**
     * Update the specified RedProduccionSubProducto in storage.
     * PUT/PATCH /red-produccion-sub-productos/{id}
     */
    public function update($id, UpdateRedProduccionSubProductoAPIRequest $request): JsonResponse
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            return $this->sendError('Red Produccion Sub Producto no encontrado');
        }

        $redProduccionSubProducto->fill($request->all());
        $redProduccionSubProducto->save();

        return $this->sendResponse($redProduccionSubProducto->toArray(), 'RedProduccionSubProducto actualizado');
    }

    /**
     * Remove the specified RedProduccionSubProducto from storage.
     * DELETE /red-produccion-sub-productos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            return $this->sendError('Red Produccion Sub Producto no encontrado');
        }

        $redProduccionSubProducto->delete();

        return $this->sendSuccess('Red Produccion Sub Producto eliminado');
    }
}
