<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEstructuraPresupuestariaProyectoAPIRequest;
use App\Http\Requests\API\UpdateEstructuraPresupuestariaProyectoAPIRequest;
use App\Models\EstructuraPresupuestariaProyecto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class EstructuraPresupuestariaProyectoAPIController
 */
class EstructuraPresupuestariaProyectoAPIController extends AppBaseController
{
    /**
     * Display a listing of the EstructuraPresupuestariaProyectos.
     * GET|HEAD /estructura-presupuestaria-proyectos
     */
    public function index(Request $request): JsonResponse
    {
        $query = EstructuraPresupuestariaProyecto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $estructuraPresupuestariaProyectos = $query->get();

        return $this->sendResponse($estructuraPresupuestariaProyectos->toArray(), 'Estructura Presupuestaria Proyectos ');
    }

    /**
     * Store a newly created EstructuraPresupuestariaProyecto in storage.
     * POST /estructura-presupuestaria-proyectos
     */
    public function store(CreateEstructuraPresupuestariaProyectoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var EstructuraPresupuestariaProyecto $estructuraPresupuestariaProyecto */
        $estructuraPresupuestariaProyecto = EstructuraPresupuestariaProyecto::create($input);

        return $this->sendResponse($estructuraPresupuestariaProyecto->toArray(), 'Estructura Presupuestaria Proyecto guardado');
    }

    /**
     * Display the specified EstructuraPresupuestariaProyecto.
     * GET|HEAD /estructura-presupuestaria-proyectos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaProyecto $estructuraPresupuestariaProyecto */
        $estructuraPresupuestariaProyecto = EstructuraPresupuestariaProyecto::find($id);

        if (empty($estructuraPresupuestariaProyecto)) {
            return $this->sendError('Estructura Presupuestaria Proyecto no encontrado');
        }

        return $this->sendResponse($estructuraPresupuestariaProyecto->toArray(), 'Estructura Presupuestaria Proyecto ');
    }

    /**
     * Update the specified EstructuraPresupuestariaProyecto in storage.
     * PUT/PATCH /estructura-presupuestaria-proyectos/{id}
     */
    public function update($id, UpdateEstructuraPresupuestariaProyectoAPIRequest $request): JsonResponse
    {
        /** @var EstructuraPresupuestariaProyecto $estructuraPresupuestariaProyecto */
        $estructuraPresupuestariaProyecto = EstructuraPresupuestariaProyecto::find($id);

        if (empty($estructuraPresupuestariaProyecto)) {
            return $this->sendError('Estructura Presupuestaria Proyecto no encontrado');
        }

        $estructuraPresupuestariaProyecto->fill($request->all());
        $estructuraPresupuestariaProyecto->save();

        return $this->sendResponse($estructuraPresupuestariaProyecto->toArray(), 'EstructuraPresupuestariaProyecto actualizado');
    }

    /**
     * Remove the specified EstructuraPresupuestariaProyecto from storage.
     * DELETE /estructura-presupuestaria-proyectos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaProyecto $estructuraPresupuestariaProyecto */
        $estructuraPresupuestariaProyecto = EstructuraPresupuestariaProyecto::find($id);

        if (empty($estructuraPresupuestariaProyecto)) {
            return $this->sendError('Estructura Presupuestaria Proyecto no encontrado');
        }

        $estructuraPresupuestariaProyecto->delete();

        return $this->sendSuccess('Estructura Presupuestaria Proyecto eliminado');
    }
}
