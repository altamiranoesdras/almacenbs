<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoSolicitudEstadoAPIRequest;
use App\Http\Requests\API\UpdateActivoSolicitudEstadoAPIRequest;
use App\Models\ActivoSolicitudEstado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoSolicitudEstadoController
 * @package App\Http\Controllers\API
 */

class ActivoSolicitudEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoSolicitudEstado.
     * GET|HEAD /activoSolicitudEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoSolicitudEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoSolicitudEstados = $query->get();

        return $this->sendResponse($activoSolicitudEstados->toArray(), 'Activo Solicitud Estados retrieved successfully');
    }

    /**
     * Store a newly created ActivoSolicitudEstado in storage.
     * POST /activoSolicitudEstados
     *
     * @param CreateActivoSolicitudEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::create($input);

        return $this->sendResponse($activoSolicitudEstado->toArray(), 'Activo Solicitud Estado guardado exitosamente');
    }

    /**
     * Display the specified ActivoSolicitudEstado.
     * GET|HEAD /activoSolicitudEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            return $this->sendError('Activo Solicitud Estado no encontrado');
        }

        return $this->sendResponse($activoSolicitudEstado->toArray(), 'Activo Solicitud Estado retrieved successfully');
    }

    /**
     * Update the specified ActivoSolicitudEstado in storage.
     * PUT/PATCH /activoSolicitudEstados/{id}
     *
     * @param int $id
     * @param UpdateActivoSolicitudEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudEstadoAPIRequest $request)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            return $this->sendError('Activo Solicitud Estado no encontrado');
        }

        $activoSolicitudEstado->fill($request->all());
        $activoSolicitudEstado->save();

        return $this->sendResponse($activoSolicitudEstado->toArray(), 'ActivoSolicitudEstado actualizado con éxito');
    }

    /**
     * Remove the specified ActivoSolicitudEstado from storage.
     * DELETE /activoSolicitudEstados/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            return $this->sendError('Activo Solicitud Estado no encontrado');
        }

        $activoSolicitudEstado->delete();

        return $this->sendSuccess('Activo Solicitud Estado deleted successfully');
    }
}
