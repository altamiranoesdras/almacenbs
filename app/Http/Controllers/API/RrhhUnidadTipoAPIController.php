<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRrhhUnidadTipoAPIRequest;
use App\Http\Requests\API\UpdateRrhhUnidadTipoAPIRequest;
use App\Models\RrhhUnidadTipo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RrhhUnidadTipoAPIController
 */
class RrhhUnidadTipoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RrhhUnidadTipos.
     * GET|HEAD /rrhh-unidad-tipos
     */
    public function index(Request $request): JsonResponse
    {
        $query = RrhhUnidadTipo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $rrhhUnidadTipos = $query->get();

        return $this->sendResponse($rrhhUnidadTipos->toArray(), 'Rrhh Unidad Tipos ');
    }

    /**
     * Store a newly created RrhhUnidadTipo in storage.
     * POST /rrhh-unidad-tipos
     */
    public function store(CreateRrhhUnidadTipoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::create($input);

        return $this->sendResponse($rrhhUnidadTipo->toArray(), 'Rrhh Unidad Tipo guardado');
    }

    /**
     * Display the specified RrhhUnidadTipo.
     * GET|HEAD /rrhh-unidad-tipos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            return $this->sendError('Rrhh Unidad Tipo no encontrado');
        }

        return $this->sendResponse($rrhhUnidadTipo->toArray(), 'Rrhh Unidad Tipo ');
    }

    /**
     * Update the specified RrhhUnidadTipo in storage.
     * PUT/PATCH /rrhh-unidad-tipos/{id}
     */
    public function update($id, UpdateRrhhUnidadTipoAPIRequest $request): JsonResponse
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            return $this->sendError('Rrhh Unidad Tipo no encontrado');
        }

        $rrhhUnidadTipo->fill($request->all());
        $rrhhUnidadTipo->save();

        return $this->sendResponse($rrhhUnidadTipo->toArray(), 'RrhhUnidadTipo actualizado');
    }

    /**
     * Remove the specified RrhhUnidadTipo from storage.
     * DELETE /rrhh-unidad-tipos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            return $this->sendError('Rrhh Unidad Tipo no encontrado');
        }

        $rrhhUnidadTipo->delete();

        return $this->sendSuccess('Rrhh Unidad Tipo eliminado');
    }
}
