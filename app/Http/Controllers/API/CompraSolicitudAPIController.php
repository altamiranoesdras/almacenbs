<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraSolicitudAPIRequest;
use App\Http\Requests\API\UpdateCompraSolicitudAPIRequest;
use App\Models\CompraSolicitud;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraSolicitudAPIController
 */
class CompraSolicitudAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraSolicituds.
     * GET|HEAD /compra-solicituds
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraSolicitud::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraSolicituds = $query->get();

        return $this->sendResponse($compraSolicituds->toArray(), 'Compra Solicituds ');
    }

    /**
     * Store a newly created CompraSolicitud in storage.
     * POST /compra-solicituds
     */
    public function store(CreateCompraSolicitudAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::create($input);

        return $this->sendResponse($compraSolicitud->toArray(), 'Compra Solicitud guardado');
    }

    /**
     * Display the specified CompraSolicitud.
     * GET|HEAD /compra-solicituds/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            return $this->sendError('Compra Solicitud no encontrado');
        }

        return $this->sendResponse($compraSolicitud->toArray(), 'Compra Solicitud ');
    }

    /**
     * Update the specified CompraSolicitud in storage.
     * PUT/PATCH /compra-solicituds/{id}
     */
    public function update($id, UpdateCompraSolicitudAPIRequest $request): JsonResponse
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            return $this->sendError('Compra Solicitud no encontrado');
        }

        $compraSolicitud->fill($request->all());
        $compraSolicitud->save();

        return $this->sendResponse($compraSolicitud->toArray(), 'CompraSolicitud actualizado');
    }

    /**
     * Remove the specified CompraSolicitud from storage.
     * DELETE /compra-solicituds/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            return $this->sendError('Compra Solicitud no encontrado');
        }

        $compraSolicitud->delete();

        return $this->sendSuccess('Compra Solicitud eliminado');
    }
}
