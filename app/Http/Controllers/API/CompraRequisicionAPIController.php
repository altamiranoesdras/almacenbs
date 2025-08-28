<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraRequisicionAPIRequest;
use App\Http\Requests\API\UpdateCompraRequisicionAPIRequest;
use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CompraRequisicionAPIController
 */
class CompraRequisicionAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraRequisicions.
     * GET|HEAD /compra-requisiciones
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraRequisicion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraRequisicions = $query->get();

        return $this->sendResponse($compraRequisicions->toArray(), 'Compra Requisicions ');
    }

    /**
     * Store a newly created CompraRequisicion in storage.
     * POST /compra-requisiciones
     */
    public function store(CreateCompraRequisicionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::create($input);

        return $this->sendResponse($compraRequisicion->toArray(), 'Compra Requisicion guardado');
    }

    /**
     * Display the specified CompraRequisicion.
     * GET|HEAD /compra-requisiciones/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            return $this->sendError('Compra Requisicion no encontrado');
        }

        return $this->sendResponse($compraRequisicion->toArray(), 'Compra Requisicion ');
    }

    /**
     * Update the specified CompraRequisicion in storage.
     * PUT/PATCH /compra-requisiciones/{id}
     */
    public function update($id, UpdateCompraRequisicionAPIRequest $request): JsonResponse
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            return $this->sendError('Compra Requisicion no encontrado');
        }

        $compraRequisicion->fill($request->all());
        $compraRequisicion->save();

        return $this->sendResponse($compraRequisicion->toArray(), 'CompraRequisicion actualizado');
    }

    /**
     * Remove the specified CompraRequisicion from storage.
     * DELETE /compra-requisiciones/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            return $this->sendError('Compra Requisicion no encontrado');
        }

        $compraRequisicion->delete();

        return $this->sendSuccess('Compra Requisicion eliminado');
    }
}
