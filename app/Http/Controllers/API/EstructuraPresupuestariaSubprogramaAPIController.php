<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateEstructuraPresupuestariaSubprogramaAPIRequest;
use App\Http\Requests\API\UpdateEstructuraPresupuestariaSubprogramaAPIRequest;
use App\Models\EstructuraPresupuestariaSubprograma;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class EstructuraPresupuestariaSubprogramaAPIController
 */
class EstructuraPresupuestariaSubprogramaAPIController extends AppBaseController
{
    /**
     * Display a listing of the EstructuraPresupuestariaSubprogramas.
     * GET|HEAD /estructura-presupuestaria-subprogramas
     */
    public function index(Request $request): JsonResponse
    {
        $query = EstructuraPresupuestariaSubprograma::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $estructuraPresupuestariaSubprogramas = $query->get();

        return $this->sendResponse($estructuraPresupuestariaSubprogramas->toArray(), 'Estructura Presupuestaria Subprogramas ');
    }

    /**
     * Store a newly created EstructuraPresupuestariaSubprograma in storage.
     * POST /estructura-presupuestaria-subprogramas
     */
    public function store(CreateEstructuraPresupuestariaSubprogramaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $input['codigo'] = $this->getCodigo();

        /** @var EstructuraPresupuestariaSubprograma $estructuraPresupuestariaSubprograma */
        $estructuraPresupuestariaSubprograma = EstructuraPresupuestariaSubprograma::create($input);

        return $this->sendResponse($estructuraPresupuestariaSubprograma->toArray(), 'Estructura Presupuestaria Subprograma guardado');
    }

    /**
     * Display the specified EstructuraPresupuestariaSubprograma.
     * GET|HEAD /estructura-presupuestaria-subprogramas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaSubprograma $estructuraPresupuestariaSubprograma */
        $estructuraPresupuestariaSubprograma = EstructuraPresupuestariaSubprograma::find($id);

        if (empty($estructuraPresupuestariaSubprograma)) {
            return $this->sendError('Estructura Presupuestaria Subprograma no encontrado');
        }

        return $this->sendResponse($estructuraPresupuestariaSubprograma->toArray(), 'Estructura Presupuestaria Subprograma ');
    }

    /**
     * Update the specified EstructuraPresupuestariaSubprograma in storage.
     * PUT/PATCH /estructura-presupuestaria-subprogramas/{id}
     */
    public function update($id, UpdateEstructuraPresupuestariaSubprogramaAPIRequest $request): JsonResponse
    {
        /** @var EstructuraPresupuestariaSubprograma $estructuraPresupuestariaSubprograma */
        $estructuraPresupuestariaSubprograma = EstructuraPresupuestariaSubprograma::find($id);

        if (empty($estructuraPresupuestariaSubprograma)) {
            return $this->sendError('Estructura Presupuestaria Subprograma no encontrado');
        }

        $estructuraPresupuestariaSubprograma->fill($request->all());
        $estructuraPresupuestariaSubprograma->save();

        return $this->sendResponse($estructuraPresupuestariaSubprograma->toArray(), 'EstructuraPresupuestariaSubprograma actualizado');
    }

    /**
     * Remove the specified EstructuraPresupuestariaSubprograma from storage.
     * DELETE /estructura-presupuestaria-subprogramas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaSubprograma $estructuraPresupuestariaSubprograma */
        $estructuraPresupuestariaSubprograma = EstructuraPresupuestariaSubprograma::find($id);

        if (empty($estructuraPresupuestariaSubprograma)) {
            return $this->sendError('Estructura Presupuestaria Subprograma no encontrado');
        }

        foreach ($estructuraPresupuestariaSubprograma->proyectos as $proyecto) {
            foreach ($proyecto->actividades as $actividad) {
                $actividad->delete();
            }
            $proyecto->delete();
        }

        $estructuraPresupuestariaSubprograma->delete();

        return $this->sendSuccess('Estructura Presupuestaria Subprograma eliminado');
    }

    public function getCodigo()
    {
        $correlativo = EstructuraPresupuestariaSubprograma::withTrashed()
            ->whereRaw('year(created_at) ='.Carbon::now()->year)
            ->max('id');

        return 'EPSP-'.Carbon::now()->year.'-'.str_pad((int)$correlativo + 1, 6, '0', STR_PAD_LEFT);
    }
}
