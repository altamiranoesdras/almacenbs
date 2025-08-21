<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraSolicitudEstadoAPIRequest;
use App\Http\Requests\API\UpdateCompraSolicitudEstadoAPIRequest;
use App\Models\CompraSolicitudEstado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CompraSolicitudEstadoAPIController
 */
class CompraSolicitudEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the compra.solicitudes.estados.
     * GET|HEAD /compra-solicitud-estados
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraSolicitudEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraSolicitudEstados = $query->get();

        return $this->sendResponse($compraSolicitudEstados->toArray(), 'Compra Solicitud Estados ');
    }

    /**
     * Store a newly created CompraSolicitudEstado in storage.
     * POST /compra-solicitud-estados
     */
    public function store(CreateCompraSolicitudEstadoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::create($input);

        return $this->sendResponse($compraSolicitudEstado->toArray(), 'Compra Solicitud Estado guardado');
    }

    /**
     * Display the specified CompraSolicitudEstado.
     * GET|HEAD /compra-solicitud-estados/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            return $this->sendError('Compra Solicitud Estado no encontrado');
        }

        return $this->sendResponse($compraSolicitudEstado->toArray(), 'Compra Solicitud Estado ');
    }

    /**
     * Update the specified CompraSolicitudEstado in storage.
     * PUT/PATCH /compra-solicitud-estados/{id}
     */
    public function update($id, UpdateCompraSolicitudEstadoAPIRequest $request): JsonResponse
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            return $this->sendError('Compra Solicitud Estado no encontrado');
        }

        $compraSolicitudEstado->fill($request->all());
        $compraSolicitudEstado->save();

        return $this->sendResponse($compraSolicitudEstado->toArray(), 'CompraSolicitudEstado actualizado');
    }

    /**
     * Remove the specified CompraSolicitudEstado from storage.
     * DELETE /compra-solicitud-estados/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            return $this->sendError('Compra Solicitud Estado no encontrado');
        }

        $compraSolicitudEstado->delete();

        return $this->sendSuccess('Compra Solicitud Estado eliminado');
    }
}
