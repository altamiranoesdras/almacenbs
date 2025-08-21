<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraRequicicionTipoAdquisicionAPIRequest;
use App\Http\Requests\API\UpdateCompraRequicicionTipoAdquisicionAPIRequest;
use App\Models\CompraRequicicionTipoAdquisicion;
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
        $query = CompraRequicicionTipoAdquisicion::query();

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
     * Store a newly created CompraRequicicionTipoAdquisicion in storage.
     * POST /compra-requisicion-tipo-adquisiciones
     */
    public function store(CreateCompraRequicicionTipoAdquisicionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::create($input);

        return $this->sendResponse($compraRequicicionTipoAdquisicion->toArray(), 'Compra Requicicion Tipo Adquisicion guardado');
    }

    /**
     * Display the specified CompraRequicicionTipoAdquisicion.
     * GET|HEAD /compra-requisicion-tipo-adquisiciones/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            return $this->sendError('Compra Requicicion Tipo Adquisicion no encontrado');
        }

        return $this->sendResponse($compraRequicicionTipoAdquisicion->toArray(), 'Compra Requicicion Tipo Adquisicion ');
    }

    /**
     * Update the specified CompraRequicicionTipoAdquisicion in storage.
     * PUT/PATCH /compra-requisicion-tipo-adquisiciones/{id}
     */
    public function update($id, UpdateCompraRequicicionTipoAdquisicionAPIRequest $request): JsonResponse
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            return $this->sendError('Compra Requicicion Tipo Adquisicion no encontrado');
        }

        $compraRequicicionTipoAdquisicion->fill($request->all());
        $compraRequicicionTipoAdquisicion->save();

        return $this->sendResponse($compraRequicicionTipoAdquisicion->toArray(), 'CompraRequicicionTipoAdquisicion actualizado');
    }

    /**
     * Remove the specified CompraRequicicionTipoAdquisicion from storage.
     * DELETE /compra-requisicion-tipo-adquisiciones/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            return $this->sendError('Compra Requicicion Tipo Adquisicion no encontrado');
        }

        $compraRequicicionTipoAdquisicion->delete();

        return $this->sendSuccess('Compra Requicicion Tipo Adquisicion eliminado');
    }
}
