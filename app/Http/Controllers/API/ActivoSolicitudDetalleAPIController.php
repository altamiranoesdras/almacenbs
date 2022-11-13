<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoSolicitudDetalleAPIRequest;
use App\Http\Requests\API\UpdateActivoSolicitudDetalleAPIRequest;
use App\Models\ActivoSolicitudDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoSolicitudDetalleController
 * @package App\Http\Controllers\API
 */

class ActivoSolicitudDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoSolicitudDetalle.
     * GET|HEAD /activoSolicitudDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoSolicitudDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        if ($request->get('solicitud_id')) {
            $query->where('solicitud_id', $request->get('solicitud_id'));
        }

        $activoSolicitudDetalles = $query->with(['activo','solicitudTipo','activoTipo'])->get();

        return $this->sendResponse($activoSolicitudDetalles->toArray(), 'Activo Solicitud Detalles retrieved successfully');
    }

    /**
     * Store a newly created ActivoSolicitudDetalle in storage.
     * POST /activoSolicitudDetalles
     *
     * @param CreateActivoSolicitudDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudDetalleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::create($input);

        return $this->sendResponse($activoSolicitudDetalle->toArray(), 'Activo Solicitud Detalle guardado exitosamente');
    }

    /**
     * Display the specified ActivoSolicitudDetalle.
     * GET|HEAD /activoSolicitudDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            return $this->sendError('Activo Solicitud Detalle no encontrado');
        }

        return $this->sendResponse($activoSolicitudDetalle->toArray(), 'Activo Solicitud Detalle retrieved successfully');
    }

    /**
     * Update the specified ActivoSolicitudDetalle in storage.
     * PUT/PATCH /activoSolicitudDetalles/{id}
     *
     * @param int $id
     * @param UpdateActivoSolicitudDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudDetalleAPIRequest $request)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            return $this->sendError('Activo Solicitud Detalle no encontrado');
        }

        $activoSolicitudDetalle->fill($request->all());
        $activoSolicitudDetalle->save();

        return $this->sendResponse($activoSolicitudDetalle->toArray(), 'ActivoSolicitudDetalle actualizado con éxito');
    }

    /**
     * Remove the specified ActivoSolicitudDetalle from storage.
     * DELETE /activoSolicitudDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            return $this->sendError('Activo Solicitud Detalle no encontrado');
        }

        $activoSolicitudDetalle->delete();

        return $this->sendSuccess('Activo Solicitud Detalle deleted successfully');
    }
}
