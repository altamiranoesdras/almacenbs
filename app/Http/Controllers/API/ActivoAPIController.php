<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoAPIRequest;
use App\Http\Requests\API\UpdateActivoAPIRequest;
use App\Models\Activo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoController
 * @package App\Http\Controllers\API
 */

class ActivoAPIController extends AppBaseController
{
    /**
     * Display a listing of the Activo.
     * GET|HEAD /activos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Activo::query()->limit(100);

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activos = $query->get();

        return $this->sendResponse($activos->toArray(), 'Activos retrieved successfully');
    }

    /**
     * Store a newly created Activo in storage.
     * POST /activos
     *
     * @param CreateActivoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Activo $activo */
        $activo = Activo::create($input);

        return $this->sendResponse($activo->toArray(), 'Activo guardado exitosamente');
    }

    /**
     * Display the specified Activo.
     * GET|HEAD /activos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            return $this->sendError('Activo no encontrado');
        }

        return $this->sendResponse($activo->toArray(), 'Activo retrieved successfully');
    }

    /**
     * Update the specified Activo in storage.
     * PUT/PATCH /activos/{id}
     *
     * @param int $id
     * @param UpdateActivoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoAPIRequest $request)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            return $this->sendError('Activo no encontrado');
        }

        $activo->fill($request->all());
        $activo->save();

        return $this->sendResponse($activo->toArray(), 'Activo actualizado con éxito');
    }

    /**
     * Remove the specified Activo from storage.
     * DELETE /activos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            return $this->sendError('Activo no encontrado');
        }

        $activo->delete();

        return $this->sendSuccess('Activo deleted successfully');
    }
}
