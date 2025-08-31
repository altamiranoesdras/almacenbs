<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraRequisicionEstadoAPIRequest;
use App\Http\Requests\API\UpdateCompraRequisicionEstadoAPIRequest;
use App\Models\CompraRequisicionEstado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CompraRequisicionEstadoAPIController
 */
class CompraRequisicionEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the compra.requisiciones.estados.
     * GET|HEAD /compra-requisicion-estados
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraRequisicionEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraRequisicionEstados = $query->get();

        return $this->sendResponse($compraRequisicionEstados->toArray(), 'Compra Requisicion Estados ');
    }

    /**
     * Store a newly created CompraRequisicionEstado in storage.
     * POST /compra-requisicion-estados
     */
    public function store(CreateCompraRequisicionEstadoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::create($input);

        return $this->sendResponse($compraRequisicionEstado->toArray(), 'Compra Requisicion Estado guardado');
    }

    /**
     * Display the specified CompraRequisicionEstado.
     * GET|HEAD /compra-requisicion-estados/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            return $this->sendError('Compra Requisicion Estado no encontrado');
        }

        return $this->sendResponse($compraRequisicionEstado->toArray(), 'Compra Requisicion Estado ');
    }

    /**
     * Update the specified CompraRequisicionEstado in storage.
     * PUT/PATCH /compra-requisicion-estados/{id}
     */
    public function update($id, UpdateCompraRequisicionEstadoAPIRequest $request): JsonResponse
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            return $this->sendError('Compra Requisicion Estado no encontrado');
        }

        $compraRequisicionEstado->fill($request->all());
        $compraRequisicionEstado->save();

        return $this->sendResponse($compraRequisicionEstado->toArray(), 'CompraRequisicionEstado actualizado');
    }

    /**
     * Remove the specified CompraRequisicionEstado from storage.
     * DELETE /compra-requisicion-estados/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            return $this->sendError('Compra Requisicion Estado no encontrado');
        }

        $compraRequisicionEstado->delete();

        return $this->sendSuccess('Compra Requisicion Estado eliminado');
    }
}
