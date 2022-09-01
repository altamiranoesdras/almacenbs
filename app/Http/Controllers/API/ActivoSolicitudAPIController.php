<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoSolicitudAPIRequest;
use App\Http\Requests\API\UpdateActivoSolicitudAPIRequest;
use App\Models\ActivoSolicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoSolicitudController
 * @package App\Http\Controllers\API
 */

class ActivoSolicitudAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoSolicitud.
     * GET|HEAD /activoSolicituds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoSolicitud::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoSolicituds = $query->get();

        return $this->sendResponse($activoSolicituds->toArray(), 'Activo Solicituds retrieved successfully');
    }

    /**
     * Store a newly created ActivoSolicitud in storage.
     * POST /activoSolicituds
     *
     * @param CreateActivoSolicitudAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::create($input);

        return $this->sendResponse($activoSolicitud->toArray(), 'Activo Solicitud guardado exitosamente');
    }

    /**
     * Display the specified ActivoSolicitud.
     * GET|HEAD /activoSolicituds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            return $this->sendError('Activo Solicitud no encontrado');
        }

        return $this->sendResponse($activoSolicitud->toArray(), 'Activo Solicitud retrieved successfully');
    }

    /**
     * Update the specified ActivoSolicitud in storage.
     * PUT/PATCH /activoSolicituds/{id}
     *
     * @param int $id
     * @param UpdateActivoSolicitudAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudAPIRequest $request)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            return $this->sendError('Activo Solicitud no encontrado');
        }

        $activoSolicitud->fill($request->all());
        $activoSolicitud->save();

        return $this->sendResponse($activoSolicitud->toArray(), 'ActivoSolicitud actualizado con éxito');
    }

    /**
     * Remove the specified ActivoSolicitud from storage.
     * DELETE /activoSolicituds/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            return $this->sendError('Activo Solicitud no encontrado');
        }

        $activoSolicitud->delete();

        return $this->sendSuccess('Activo Solicitud deleted successfully');
    }
}
