<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateEstructuraPresupuestariaProgramaAPIRequest;
use App\Http\Requests\API\UpdateEstructuraPresupuestariaProgramaAPIRequest;
use App\Models\EstructuraPresupuestariaPrograma;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class EstructuraPresupuestariaProgramaAPIController
 */
class EstructuraPresupuestariaProgramaAPIController extends AppBaseController
{
    /**
     * Display a listing of the EstructuraPresupuestariaProgramas.
     * GET|HEAD /estructura-presupuestaria-programas
     */
    public function index(Request $request): JsonResponse
    {
        $query = EstructuraPresupuestariaPrograma::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $estructuraPresupuestariaProgramas = $query->with('subProgramas.proyectos.actividades')
            ->get();

        return $this->sendResponse($estructuraPresupuestariaProgramas->toArray(), 'Estructura Presupuestaria Programas ');
    }

    /**
     * Store a newly created EstructuraPresupuestariaPrograma in storage.
     * POST /estructura-presupuestaria-programas
     */
    public function store(CreateEstructuraPresupuestariaProgramaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $input['codigo'] = $this->getCodigo();

        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::create($input);

        return $this->sendResponse($estructuraPresupuestariaPrograma->toArray(), 'Estructura Presupuestaria Programa guardado');
    }

    /**
     * Display the specified EstructuraPresupuestariaPrograma.
     * GET|HEAD /estructura-presupuestaria-programas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            return $this->sendError('Estructura Presupuestaria Programa no encontrado');
        }

        return $this->sendResponse($estructuraPresupuestariaPrograma->toArray(), 'Estructura Presupuestaria Programa ');
    }

    /**
     * Update the specified EstructuraPresupuestariaPrograma in storage.
     * PUT/PATCH /estructura-presupuestaria-programas/{id}
     */
    public function update($id, UpdateEstructuraPresupuestariaProgramaAPIRequest $request): JsonResponse
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            return $this->sendError('Estructura Presupuestaria Programa no encontrado');
        }

        $estructuraPresupuestariaPrograma->fill($request->all());
        $estructuraPresupuestariaPrograma->save();

        return $this->sendResponse($estructuraPresupuestariaPrograma->toArray(), 'EstructuraPresupuestariaPrograma actualizado');
    }

    /**
     * Remove the specified EstructuraPresupuestariaPrograma from storage.
     * DELETE /estructura-presupuestaria-programas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::with('subProgramas.proyectos.actividades')
            ->find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            return $this->sendError('Estructura Presupuestaria Programa no encontrado');
        }

        foreach ($estructuraPresupuestariaPrograma->subProgramas as $subPrograma) {
            foreach ($subPrograma->proyectos as $proyecto) {
                foreach ($proyecto->actividades as $actividad) {
                    $actividad->delete();
                }
                $proyecto->delete();
            }
            $subPrograma->delete();
        }

        $estructuraPresupuestariaPrograma->delete();

        return $this->sendSuccess('Estructura Presupuestaria Programa eliminado');
    }


    public function getCodigo()
    {
        $correlativo = EstructuraPresupuestariaPrograma::withTrashed()
            ->whereRaw('year(created_at) ='.Carbon::now()->year)
            ->max('id');

        return 'EPP-'.Carbon::now()->year.'-'.str_pad((int)$correlativo + 1, 6, '0', STR_PAD_LEFT);
    }

}
