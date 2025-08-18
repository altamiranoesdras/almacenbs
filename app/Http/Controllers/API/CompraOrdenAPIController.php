<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraOrdenAPIRequest;
use App\Http\Requests\API\UpdateCompraOrdenAPIRequest;
use App\Models\CompraOrden;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraOrdenAPIController
 */
class CompraOrdenAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraOrdens.
     * GET|HEAD /compra-ordens
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraOrden::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraOrdens = $query->get();

        return $this->sendResponse($compraOrdens->toArray(), 'Compra Ordens ');
    }

    /**
     * Store a newly created CompraOrden in storage.
     * POST /compra-ordens
     */
    public function store(CreateCompraOrdenAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::create($input);

        return $this->sendResponse($compraOrden->toArray(), 'Compra Orden guardado');
    }

    /**
     * Display the specified CompraOrden.
     * GET|HEAD /compra-ordens/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            return $this->sendError('Compra Orden no encontrado');
        }

        return $this->sendResponse($compraOrden->toArray(), 'Compra Orden ');
    }

    /**
     * Update the specified CompraOrden in storage.
     * PUT/PATCH /compra-ordens/{id}
     */
    public function update($id, UpdateCompraOrdenAPIRequest $request): JsonResponse
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            return $this->sendError('Compra Orden no encontrado');
        }

        $compraOrden->fill($request->all());
        $compraOrden->save();

        return $this->sendResponse($compraOrden->toArray(), 'CompraOrden actualizado');
    }

    /**
     * Remove the specified CompraOrden from storage.
     * DELETE /compra-ordens/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            return $this->sendError('Compra Orden no encontrado');
        }

        $compraOrden->delete();

        return $this->sendSuccess('Compra Orden eliminado');
    }
}
