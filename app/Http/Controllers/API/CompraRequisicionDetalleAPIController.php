<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraRequisicionDetalleAPIRequest;
use App\Http\Requests\API\UpdateCompraRequisicionDetalleAPIRequest;
use App\Models\CompraRequisicionDetalle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraRequisicionDetalleAPIController
 */
class CompraRequisicionDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraRequisicionDetalles.
     * GET|HEAD /compra-requisicion-detalles
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraRequisicionDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraRequisicionDetalles = $query->get();

        return $this->sendResponse($compraRequisicionDetalles->toArray(), 'Compra Requisicion Detalles ');
    }

    /**
     * Store a newly created CompraRequisicionDetalle in storage.
     * POST /compra-requisicion-detalles
     */
    public function store(CreateCompraRequisicionDetalleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::create($input);

        return $this->sendResponse($compraRequisicionDetalle->toArray(), 'Compra Requisicion Detalle guardado');
    }

    /**
     * Display the specified CompraRequisicionDetalle.
     * GET|HEAD /compra-requisicion-detalles/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            return $this->sendError('Compra Requisicion Detalle no encontrado');
        }

        return $this->sendResponse($compraRequisicionDetalle->toArray(), 'Compra Requisicion Detalle ');
    }

    /**
     * Update the specified CompraRequisicionDetalle in storage.
     * PUT/PATCH /compra-requisicion-detalles/{id}
     */
    public function update($id, UpdateCompraRequisicionDetalleAPIRequest $request): JsonResponse
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            return $this->sendError('Compra Requisicion Detalle no encontrado');
        }

        $compraRequisicionDetalle->fill($request->all());
        $compraRequisicionDetalle->save();

        return $this->sendResponse($compraRequisicionDetalle->toArray(), 'CompraRequisicionDetalle actualizado');
    }

    /**
     * Remove the specified CompraRequisicionDetalle from storage.
     * DELETE /compra-requisicion-detalles/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            return $this->sendError('Compra Requisicion Detalle no encontrado');
        }

        $compraRequisicionDetalle->delete();

        return $this->sendSuccess('Compra Requisicion Detalle eliminado');
    }
}
