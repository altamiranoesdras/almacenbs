<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoTipoAPIRequest;
use App\Http\Requests\API\UpdateActivoTipoAPIRequest;
use App\Models\ActivoTipo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoTipoController
 * @package App\Http\Controllers\API
 */

class ActivoTipoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoTipo.
     * GET|HEAD /activoTipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoTipo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoTipos = $query->get();

        return $this->sendResponse($activoTipos->toArray(), 'Activo Tipos retrieved successfully');
    }

    /**
     * Store a newly created ActivoTipo in storage.
     * POST /activoTipos
     *
     * @param CreateActivoTipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::create($input);

        return $this->sendResponse($activoTipo->toArray(), 'Activo Tipo guardado exitosamente');
    }

    /**
     * Display the specified ActivoTipo.
     * GET|HEAD /activoTipos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            return $this->sendError('Activo Tipo no encontrado');
        }

        return $this->sendResponse($activoTipo->toArray(), 'Activo Tipo retrieved successfully');
    }

    /**
     * Update the specified ActivoTipo in storage.
     * PUT/PATCH /activoTipos/{id}
     *
     * @param int $id
     * @param UpdateActivoTipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTipoAPIRequest $request)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            return $this->sendError('Activo Tipo no encontrado');
        }

        $activoTipo->fill($request->all());
        $activoTipo->save();

        return $this->sendResponse($activoTipo->toArray(), 'ActivoTipo actualizado con éxito');
    }

    /**
     * Remove the specified ActivoTipo from storage.
     * DELETE /activoTipos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            return $this->sendError('Activo Tipo no encontrado');
        }

        $activoTipo->delete();

        return $this->sendSuccess('Activo Tipo deleted successfully');
    }
}
