<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraOrdenDetalleAPIRequest;
use App\Http\Requests\API\UpdateCompraOrdenDetalleAPIRequest;
use App\Models\CompraOrdenDetalle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraOrdenDetalleAPIController
 */
class CompraOrdenDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraOrdenDetalles.
     * GET|HEAD /compra-orden-detalles
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraOrdenDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraOrdenDetalles = $query->get();

        return $this->sendResponse($compraOrdenDetalles->toArray(), 'Compra Orden Detalles ');
    }

    /**
     * Store a newly created CompraOrdenDetalle in storage.
     * POST /compra-orden-detalles
     */
    public function store(CreateCompraOrdenDetalleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::create($input);

        return $this->sendResponse($compraOrdenDetalle->toArray(), 'Compra Orden Detalle guardado');
    }

    /**
     * Display the specified CompraOrdenDetalle.
     * GET|HEAD /compra-orden-detalles/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            return $this->sendError('Compra Orden Detalle no encontrado');
        }

        return $this->sendResponse($compraOrdenDetalle->toArray(), 'Compra Orden Detalle ');
    }

    /**
     * Update the specified CompraOrdenDetalle in storage.
     * PUT/PATCH /compra-orden-detalles/{id}
     */
    public function update($id, UpdateCompraOrdenDetalleAPIRequest $request): JsonResponse
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            return $this->sendError('Compra Orden Detalle no encontrado');
        }

        $compraOrdenDetalle->fill($request->all());
        $compraOrdenDetalle->save();

        return $this->sendResponse($compraOrdenDetalle->toArray(), 'CompraOrdenDetalle actualizado');
    }

    /**
     * Remove the specified CompraOrdenDetalle from storage.
     * DELETE /compra-orden-detalles/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            return $this->sendError('Compra Orden Detalle no encontrado');
        }

        $compraOrdenDetalle->delete();

        return $this->sendSuccess('Compra Orden Detalle eliminado');
    }
}
