<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCostoCentroAPIRequest;
use App\Http\Requests\API\UpdateCostoCentroAPIRequest;
use App\Models\CostoCentro;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CostoCentroAPIController
 */
class CostoCentroAPIController extends AppBaseController
{
    /**
     * Display a listing of the CostoCentros.
     * GET|HEAD /costo-centros
     */
    public function index(Request $request): JsonResponse
    {
        $query = CostoCentro::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $costoCentros = $query->get();

        return $this->sendResponse($costoCentros->toArray(), 'Costo Centros ');
    }

    /**
     * Store a newly created CostoCentro in storage.
     * POST /costo-centros
     */
    public function store(CreateCostoCentroAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::create($input);

        return $this->sendResponse($costoCentro->toArray(), 'Costo Centro guardado');
    }

    /**
     * Display the specified CostoCentro.
     * GET|HEAD /costo-centros/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            return $this->sendError('Costo Centro no encontrado');
        }

        return $this->sendResponse($costoCentro->toArray(), 'Costo Centro ');
    }

    /**
     * Update the specified CostoCentro in storage.
     * PUT/PATCH /costo-centros/{id}
     */
    public function update($id, UpdateCostoCentroAPIRequest $request): JsonResponse
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            return $this->sendError('Costo Centro no encontrado');
        }

        $costoCentro->fill($request->all());
        $costoCentro->save();

        return $this->sendResponse($costoCentro->toArray(), 'CostoCentro actualizado');
    }

    /**
     * Remove the specified CostoCentro from storage.
     * DELETE /costo-centros/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            return $this->sendError('Costo Centro no encontrado');
        }

        $costoCentro->delete();

        return $this->sendSuccess('Costo Centro eliminado');
    }
}
