<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoTarjetaEstadoAPIRequest;
use App\Http\Requests\API\UpdateActivoTarjetaEstadoAPIRequest;
use App\Models\ActivoTarjetaEstado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoTarjetaEstadoController
 * @package App\Http\Controllers\API
 */

class ActivoTarjetaEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoTarjetaEstado.
     * GET|HEAD /activoTarjetaEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoTarjetaEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoTarjetaEstados = $query->get();

        return $this->sendResponse($activoTarjetaEstados->toArray(), 'Activo Tarjeta Estados retrieved successfully');
    }

    /**
     * Store a newly created ActivoTarjetaEstado in storage.
     * POST /activoTarjetaEstados
     *
     * @param CreateActivoTarjetaEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::create($input);

        return $this->sendResponse($activoTarjetaEstado->toArray(), 'Activo Tarjeta Estado guardado exitosamente');
    }

    /**
     * Display the specified ActivoTarjetaEstado.
     * GET|HEAD /activoTarjetaEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            return $this->sendError('Activo Tarjeta Estado no encontrado');
        }

        return $this->sendResponse($activoTarjetaEstado->toArray(), 'Activo Tarjeta Estado retrieved successfully');
    }

    /**
     * Update the specified ActivoTarjetaEstado in storage.
     * PUT/PATCH /activoTarjetaEstados/{id}
     *
     * @param int $id
     * @param UpdateActivoTarjetaEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaEstadoAPIRequest $request)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            return $this->sendError('Activo Tarjeta Estado no encontrado');
        }

        $activoTarjetaEstado->fill($request->all());
        $activoTarjetaEstado->save();

        return $this->sendResponse($activoTarjetaEstado->toArray(), 'ActivoTarjetaEstado actualizado con éxito');
    }

    /**
     * Remove the specified ActivoTarjetaEstado from storage.
     * DELETE /activoTarjetaEstados/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            return $this->sendError('Activo Tarjeta Estado no encontrado');
        }

        $activoTarjetaEstado->delete();

        return $this->sendSuccess('Activo Tarjeta Estado deleted successfully');
    }
}
