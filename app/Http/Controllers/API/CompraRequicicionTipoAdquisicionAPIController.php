<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraRequicicionTipoAdquisicionAPIRequest;
use App\Http\Requests\API\UpdateCompraRequicicionTipoAdquisicionAPIRequest;
use App\Models\CompraRequisicionTipoAdquisicion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CompraRequicicionTipoAdquisicionAPIController
 */
class CompraRequicicionTipoAdquisicionAPIController extends AppBaseController
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

        $compraRequicicionTipoadquisiciones = $query->get();

        return $this->sendResponse($compraRequicicionTipoadquisiciones->toArray(), 'Compra Requicicion Tipo adquisiciones ');
    }

    /**
     * Store a newly created CompraRequisicionTipoAdquisicion in storage.
     * POST /compra-requisicion-tipo-adquisiciones
     */
    public function store(CreateCompraRequicicionTipoAdquisicionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::create($input);

        return $this->sendResponse($compraRequicicionTipoAdquisicion->toArray(), 'Compra Requicicion Tipo Adquisicion guardado');
    }

    /**
     * Display the specified CompraRequisicionTipoAdquisicion.
     * GET|HEAD /compra-requisicion-tipo-adquisiciones/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            return $this->sendError('Compra Requicicion Tipo Adquisicion no encontrado');
        }

        return $this->sendResponse($compraRequicicionTipoAdquisicion->toArray(), 'Compra Requicicion Tipo Adquisicion ');
    }

    /**
     * Update the specified CompraRequisicionTipoAdquisicion in storage.
     * PUT/PATCH /compra-requisicion-tipo-adquisiciones/{id}
     */
    public function update($id, UpdateCompraRequicicionTipoAdquisicionAPIRequest $request): JsonResponse
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            return $this->sendError('Compra Requicicion Tipo Adquisicion no encontrado');
        }

        $compraRequicicionTipoAdquisicion->fill($request->all());
        $compraRequicicionTipoAdquisicion->save();

        return $this->sendResponse($compraRequicicionTipoAdquisicion->toArray(), 'CompraRequisicionTipoAdquisicion actualizado');
    }

    /**
     * Remove the specified CompraRequisicionTipoAdquisicion from storage.
     * DELETE /compra-requisicion-tipo-adquisiciones/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            return $this->sendError('Compra Requicicion Tipo Adquisicion no encontrado');
        }

        $compraRequicicionTipoAdquisicion->delete();

        return $this->sendSuccess('Compra Requicicion Tipo Adquisicion eliminado');
    }
}
