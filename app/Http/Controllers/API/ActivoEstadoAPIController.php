<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoEstadoAPIRequest;
use App\Http\Requests\API\UpdateActivoEstadoAPIRequest;
use App\Models\ActivoEstado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoEstadoController
 * @package App\Http\Controllers\API
 */

class ActivoEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoEstado.
     * GET|HEAD /activoEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoEstados = $query->get();

        return $this->sendResponse($activoEstados->toArray(), 'Activo Estados retrieved successfully');
    }

    /**
     * Store a newly created ActivoEstado in storage.
     * POST /activoEstados
     *
     * @param CreateActivoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::create($input);

        return $this->sendResponse($activoEstado->toArray(), 'Activo Estado guardado exitosamente');
    }

    /**
     * Display the specified ActivoEstado.
     * GET|HEAD /activoEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            return $this->sendError('Activo Estado no encontrado');
        }

        return $this->sendResponse($activoEstado->toArray(), 'Activo Estado retrieved successfully');
    }

    /**
     * Update the specified ActivoEstado in storage.
     * PUT/PATCH /activoEstados/{id}
     *
     * @param int $id
     * @param UpdateActivoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoEstadoAPIRequest $request)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            return $this->sendError('Activo Estado no encontrado');
        }

        $activoEstado->fill($request->all());
        $activoEstado->save();

        return $this->sendResponse($activoEstado->toArray(), 'ActivoEstado actualizado con éxito');
    }

    /**
     * Remove the specified ActivoEstado from storage.
     * DELETE /activoEstados/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            return $this->sendError('Activo Estado no encontrado');
        }

        $activoEstado->delete();

        return $this->sendSuccess('Activo Estado deleted successfully');
    }
}
