<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraSolicitudDetalleAPIRequest;
use App\Http\Requests\API\UpdateCompraSolicitudDetalleAPIRequest;
use App\Models\CompraSolicitudDetalle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraSolicitudDetalleAPIController
 */
class CompraSolicitudDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraSolicitudDetalles.
     * GET|HEAD /compra-solicitud-detalles
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraSolicitudDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraSolicitudDetalles = $query->get();

        return $this->sendResponse($compraSolicitudDetalles->toArray(), 'Compra Solicitud Detalles ');
    }

    /**
     * Store a newly created CompraSolicitudDetalle in storage.
     * POST /compra-solicitud-detalles
     */
    public function store(CreateCompraSolicitudDetalleAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::create($input);

        return $this->sendResponse($compraSolicitudDetalle->toArray(), 'Compra Solicitud Detalle guardado');
    }

    /**
     * Display the specified CompraSolicitudDetalle.
     * GET|HEAD /compra-solicitud-detalles/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            return $this->sendError('Compra Solicitud Detalle no encontrado');
        }

        return $this->sendResponse($compraSolicitudDetalle->toArray(), 'Compra Solicitud Detalle ');
    }

    /**
     * Update the specified CompraSolicitudDetalle in storage.
     * PUT/PATCH /compra-solicitud-detalles/{id}
     */
    public function update($id, UpdateCompraSolicitudDetalleAPIRequest $request): JsonResponse
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            return $this->sendError('Compra Solicitud Detalle no encontrado');
        }

        $compraSolicitudDetalle->fill($request->all());
        $compraSolicitudDetalle->save();

        return $this->sendResponse($compraSolicitudDetalle->toArray(), 'CompraSolicitudDetalle actualizado');
    }

    /**
     * Remove the specified CompraSolicitudDetalle from storage.
     * DELETE /compra-solicitud-detalles/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            return $this->sendError('Compra Solicitud Detalle no encontrado');
        }

        $compraSolicitudDetalle->delete();

        return $this->sendSuccess('Compra Solicitud Detalle eliminado');
    }
}
