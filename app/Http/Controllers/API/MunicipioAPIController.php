<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMunicipioAPIRequest;
use App\Http\Requests\API\UpdateMunicipioAPIRequest;
use App\Models\Municipio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class MunicipioAPIController
 */
class MunicipioAPIController extends AppBaseController
{
    /**
     * Display a listing of the Municipios.
     * GET|HEAD /municipios
     */
    public function index(Request $request): JsonResponse
    {
        $query = Municipio::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $municipios = $query->get();

        return $this->sendResponse($municipios->toArray(), 'Municipios ');
    }

    /**
     * Store a newly created Municipio in storage.
     * POST /municipios
     */
    public function store(CreateMunicipioAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Municipio $municipio */
        $municipio = Municipio::create($input);

        return $this->sendResponse($municipio->toArray(), 'Municipio guardado');
    }

    /**
     * Display the specified Municipio.
     * GET|HEAD /municipios/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            return $this->sendError('Municipio no encontrado');
        }

        return $this->sendResponse($municipio->toArray(), 'Municipio ');
    }

    /**
     * Update the specified Municipio in storage.
     * PUT/PATCH /municipios/{id}
     */
    public function update($id, UpdateMunicipioAPIRequest $request): JsonResponse
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            return $this->sendError('Municipio no encontrado');
        }

        $municipio->fill($request->all());
        $municipio->save();

        return $this->sendResponse($municipio->toArray(), 'Municipio actualizado');
    }

    /**
     * Remove the specified Municipio from storage.
     * DELETE /municipios/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            return $this->sendError('Municipio no encontrado');
        }

        $municipio->delete();

        return $this->sendSuccess('Municipio eliminado');
    }
}
