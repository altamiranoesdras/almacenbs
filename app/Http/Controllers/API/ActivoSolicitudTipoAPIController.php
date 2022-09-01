<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoSolicitudTipoAPIRequest;
use App\Http\Requests\API\UpdateActivoSolicitudTipoAPIRequest;
use App\Models\ActivoSolicitudTipo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoSolicitudTipoController
 * @package App\Http\Controllers\API
 */

class ActivoSolicitudTipoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoSolicitudTipo.
     * GET|HEAD /activoSolicitudTipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoSolicitudTipo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoSolicitudTipos = $query->get();

        return $this->sendResponse($activoSolicitudTipos->toArray(), 'Activo Solicitud Tipos retrieved successfully');
    }

    /**
     * Store a newly created ActivoSolicitudTipo in storage.
     * POST /activoSolicitudTipos
     *
     * @param CreateActivoSolicitudTipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::create($input);

        return $this->sendResponse($activoSolicitudTipo->toArray(), 'Activo Solicitud Tipo guardado exitosamente');
    }

    /**
     * Display the specified ActivoSolicitudTipo.
     * GET|HEAD /activoSolicitudTipos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            return $this->sendError('Activo Solicitud Tipo no encontrado');
        }

        return $this->sendResponse($activoSolicitudTipo->toArray(), 'Activo Solicitud Tipo retrieved successfully');
    }

    /**
     * Update the specified ActivoSolicitudTipo in storage.
     * PUT/PATCH /activoSolicitudTipos/{id}
     *
     * @param int $id
     * @param UpdateActivoSolicitudTipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudTipoAPIRequest $request)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            return $this->sendError('Activo Solicitud Tipo no encontrado');
        }

        $activoSolicitudTipo->fill($request->all());
        $activoSolicitudTipo->save();

        return $this->sendResponse($activoSolicitudTipo->toArray(), 'ActivoSolicitudTipo actualizado con éxito');
    }

    /**
     * Remove the specified ActivoSolicitudTipo from storage.
     * DELETE /activoSolicitudTipos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            return $this->sendError('Activo Solicitud Tipo no encontrado');
        }

        $activoSolicitudTipo->delete();

        return $this->sendSuccess('Activo Solicitud Tipo deleted successfully');
    }
}
