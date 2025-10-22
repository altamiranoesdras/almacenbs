<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRegionAPIRequest;
use App\Http\Requests\API\UpdateRegionAPIRequest;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RegionAPIController
 */
class RegionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Regions.
     * GET|HEAD /regiones
     */
    public function index(Request $request): JsonResponse
    {
        $query = Region::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $Regiones = $query->get();

        return $this->sendResponse($Regiones->toArray(), 'Regions ');
    }

    /**
     * Store a newly created Region in storage.
     * POST /regiones
     */
    public function store(CreateRegionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Region $region */
        $region = Region::create($input);

        return $this->sendResponse($region->toArray(), 'Region guardado');
    }

    /**
     * Display the specified Region.
     * GET|HEAD /regiones/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            return $this->sendError('Region no encontrado');
        }

        return $this->sendResponse($region->toArray(), 'Region ');
    }

    /**
     * Update the specified Region in storage.
     * PUT/PATCH /regiones/{id}
     */
    public function update($id, UpdateRegionAPIRequest $request): JsonResponse
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            return $this->sendError('Region no encontrado');
        }

        $region->fill($request->all());
        $region->save();

        return $this->sendResponse($region->toArray(), 'Region actualizado');
    }

    /**
     * Remove the specified Region from storage.
     * DELETE /regiones/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            return $this->sendError('Region no encontrado');
        }

        $region->delete();

        return $this->sendSuccess('Region eliminado');
    }
}
