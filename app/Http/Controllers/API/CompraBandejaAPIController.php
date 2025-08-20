<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraBandejaAPIRequest;
use App\Http\Requests\API\UpdateCompraBandejaAPIRequest;
use App\Models\CompraBandeja;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraBandejaAPIController
 */
class CompraBandejaAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraBandejas.
     * GET|HEAD /compra-bandejas
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraBandeja::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraBandejas = $query->get();

        return $this->sendResponse($compraBandejas->toArray(), 'Compra Bandejas ');
    }

    /**
     * Store a newly created CompraBandeja in storage.
     * POST /compra-bandejas
     */
    public function store(CreateCompraBandejaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::create($input);

        return $this->sendResponse($compraBandeja->toArray(), 'Compra Bandeja guardado');
    }

    /**
     * Display the specified CompraBandeja.
     * GET|HEAD /compra-bandejas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            return $this->sendError('Compra Bandeja no encontrado');
        }

        return $this->sendResponse($compraBandeja->toArray(), 'Compra Bandeja ');
    }

    /**
     * Update the specified CompraBandeja in storage.
     * PUT/PATCH /compra-bandejas/{id}
     */
    public function update($id, UpdateCompraBandejaAPIRequest $request): JsonResponse
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            return $this->sendError('Compra Bandeja no encontrado');
        }

        $compraBandeja->fill($request->all());
        $compraBandeja->save();

        return $this->sendResponse($compraBandeja->toArray(), 'CompraBandeja actualizado');
    }

    /**
     * Remove the specified CompraBandeja from storage.
     * DELETE /compra-bandejas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            return $this->sendError('Compra Bandeja no encontrado');
        }

        $compraBandeja->delete();

        return $this->sendSuccess('Compra Bandeja eliminado');
    }
}
