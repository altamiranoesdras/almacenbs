<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraRequisicionTipoAdquisicionAPIRequest;
use App\Http\Requests\API\UpdateCompraRequisicionTipoAdquisicionAPIRequest;
use App\Models\CompraRequisicionTipoAdquisicion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CompraRequisicionTipoAdquisicionAPIController
 */
class CompraRequisicionTipoAdquisicionAPIController extends AppBaseController
{
    /**
     * Display a listing of the compra.requisiciones.tipo-adquisiciones.
     * GET|HEAD /compra-requisicion-tipo-adquisiciones
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraRequisicionTipoAdquisicion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraRequisicionTipoadquisiciones = $query->get();

        return $this->sendResponse($compraRequisicionTipoadquisiciones->toArray(), 'Compra Requisicion Tipo adquisiciones ');
    }

    /**
     * Store a newly created CompraRequisicionTipoAdquisicion in storage.
     * POST /compra-requisicion-tipo-adquisiciones
     */
    public function store(CreateCompraRequisicionTipoAdquisicionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::create($input);

        return $this->sendResponse($compraRequisicionTipoAdquisicion->toArray(), 'Compra Requisicion Tipo Adquisicion guardado');
    }

    /**
     * Display the specified CompraRequisicionTipoAdquisicion.
     * GET|HEAD /compra-requisicion-tipo-adquisiciones/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            return $this->sendError('Compra Requisicion Tipo Adquisicion no encontrado');
        }

        return $this->sendResponse($compraRequisicionTipoAdquisicion->toArray(), 'Compra Requisicion Tipo Adquisicion ');
    }

    /**
     * Update the specified CompraRequisicionTipoAdquisicion in storage.
     * PUT/PATCH /compra-requisicion-tipo-adquisiciones/{id}
     */
    public function update($id, UpdateCompraRequisicionTipoAdquisicionAPIRequest $request): JsonResponse
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            return $this->sendError('Compra Requisicion Tipo Adquisicion no encontrado');
        }

        $compraRequisicionTipoAdquisicion->fill($request->all());
        $compraRequisicionTipoAdquisicion->save();

        return $this->sendResponse($compraRequisicionTipoAdquisicion->toArray(), 'CompraRequisicionTipoAdquisicion actualizado');
    }

    /**
     * Remove the specified CompraRequisicionTipoAdquisicion from storage.
     * DELETE /compra-requisicion-tipo-adquisiciones/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            return $this->sendError('Compra Requisicion Tipo Adquisicion no encontrado');
        }

        $compraRequisicionTipoAdquisicion->delete();

        return $this->sendSuccess('Compra Requisicion Tipo Adquisicion eliminado');
    }
}
