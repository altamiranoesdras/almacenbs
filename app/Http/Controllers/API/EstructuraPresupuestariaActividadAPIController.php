<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateEstructuraPresupuestariaActividadAPIRequest;
use App\Http\Requests\API\UpdateEstructuraPresupuestariaActividadAPIRequest;
use App\Models\EstructuraPresupuestariaActividad;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class EstructuraPresupuestariaActividadAPIController
 */
class EstructuraPresupuestariaActividadAPIController extends AppBaseController
{
    /**
     * Display a listing of the EstructuraPresupuestariaActividads.
     * GET|HEAD /estructura-presupuestaria-actividads
     */
    public function index(Request $request): JsonResponse
    {
        $query = EstructuraPresupuestariaActividad::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $estructuraPresupuestariaActividads = $query->get();

        return $this->sendResponse($estructuraPresupuestariaActividads->toArray(), 'Estructura Presupuestaria Actividads ');
    }

    /**
     * Store a newly created EstructuraPresupuestariaActividad in storage.
     * POST /estructura-presupuestaria-actividads
     */
    public function store(CreateEstructuraPresupuestariaActividadAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $input['codigo'] = $this->getCodigo();

        /** @var EstructuraPresupuestariaActividad $estructuraPresupuestariaActividad */
        $estructuraPresupuestariaActividad = EstructuraPresupuestariaActividad::create($input);

        return $this->sendResponse($estructuraPresupuestariaActividad->toArray(), 'Estructura Presupuestaria Actividad guardado');
    }

    /**
     * Display the specified EstructuraPresupuestariaActividad.
     * GET|HEAD /estructura-presupuestaria-actividads/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaActividad $estructuraPresupuestariaActividad */
        $estructuraPresupuestariaActividad = EstructuraPresupuestariaActividad::find($id);

        if (empty($estructuraPresupuestariaActividad)) {
            return $this->sendError('Estructura Presupuestaria Actividad no encontrado');
        }

        return $this->sendResponse($estructuraPresupuestariaActividad->toArray(), 'Estructura Presupuestaria Actividad ');
    }

    /**
     * Update the specified EstructuraPresupuestariaActividad in storage.
     * PUT/PATCH /estructura-presupuestaria-actividads/{id}
     */
    public function update($id, UpdateEstructuraPresupuestariaActividadAPIRequest $request): JsonResponse
    {
        /** @var EstructuraPresupuestariaActividad $estructuraPresupuestariaActividad */
        $estructuraPresupuestariaActividad = EstructuraPresupuestariaActividad::find($id);

        if (empty($estructuraPresupuestariaActividad)) {
            return $this->sendError('Estructura Presupuestaria Actividad no encontrado');
        }

        $estructuraPresupuestariaActividad->fill($request->all());
        $estructuraPresupuestariaActividad->save();

        return $this->sendResponse($estructuraPresupuestariaActividad->toArray(), 'EstructuraPresupuestariaActividad actualizado');
    }

    /**
     * Remove the specified EstructuraPresupuestariaActividad from storage.
     * DELETE /estructura-presupuestaria-actividads/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaActividad $estructuraPresupuestariaActividad */
        $estructuraPresupuestariaActividad = EstructuraPresupuestariaActividad::find($id);

        if (empty($estructuraPresupuestariaActividad)) {
            return $this->sendError('Estructura Presupuestaria Actividad no encontrado');
        }

        $estructuraPresupuestariaActividad->delete();

        return $this->sendSuccess('Estructura Presupuestaria Actividad eliminado');
    }

    public function getCodigo()
    {
        $correlativo = EstructuraPresupuestariaActividad::withTrashed()
            ->whereRaw('year(created_at) ='.Carbon::now()->year)
            ->max('id');

        return 'EPP-'.Carbon::now()->year.'-'.str_pad((int)$correlativo + 1, 6, '0', STR_PAD_LEFT);
    }


}
