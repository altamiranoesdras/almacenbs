<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraRequicicionEstadoAPIRequest;
use App\Http\Requests\API\UpdateCompraRequicicionEstadoAPIRequest;
use App\Models\CompraRequicicionEstado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CompraRequicicionEstadoAPIController
 */
class CompraRequicicionEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the compra.requisiciones.estados.
     * GET|HEAD /compra-requisicion-estados
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraRequicicionEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraRequicicionEstados = $query->get();

        return $this->sendResponse($compraRequicicionEstados->toArray(), 'Compra Requicicion Estados ');
    }

    /**
     * Store a newly created CompraRequicicionEstado in storage.
     * POST /compra-requisicion-estados
     */
    public function store(CreateCompraRequicicionEstadoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::create($input);

        return $this->sendResponse($compraRequicicionEstado->toArray(), 'Compra Requicicion Estado guardado');
    }

    /**
     * Display the specified CompraRequicicionEstado.
     * GET|HEAD /compra-requisicion-estados/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            return $this->sendError('Compra Requicicion Estado no encontrado');
        }

        return $this->sendResponse($compraRequicicionEstado->toArray(), 'Compra Requicicion Estado ');
    }

    /**
     * Update the specified CompraRequicicionEstado in storage.
     * PUT/PATCH /compra-requisicion-estados/{id}
     */
    public function update($id, UpdateCompraRequicicionEstadoAPIRequest $request): JsonResponse
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            return $this->sendError('Compra Requicicion Estado no encontrado');
        }

        $compraRequicicionEstado->fill($request->all());
        $compraRequicicionEstado->save();

        return $this->sendResponse($compraRequicicionEstado->toArray(), 'CompraRequicicionEstado actualizado');
    }

    /**
     * Remove the specified CompraRequicicionEstado from storage.
     * DELETE /compra-requisicion-estados/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            return $this->sendError('Compra Requicicion Estado no encontrado');
        }

        $compraRequicicionEstado->delete();

        return $this->sendSuccess('Compra Requicicion Estado eliminado');
    }
}
