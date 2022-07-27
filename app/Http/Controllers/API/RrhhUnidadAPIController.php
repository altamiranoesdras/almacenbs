<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRrhhUnidadAPIRequest;
use App\Http\Requests\API\UpdateRrhhUnidadAPIRequest;
use App\Models\RrhhUnidad;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RrhhUnidadController
 * @package App\Http\Controllers\API
 */

class RrhhUnidadAPIController extends AppBaseController
{
    /**
     * Display a listing of the RrhhUnidad.
     * GET|HEAD /rrhhUnidads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = RrhhUnidad::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $rrhhUnidads = $query->get();

        return $this->sendResponse($rrhhUnidads->toArray(), 'Rrhh Unidads retrieved successfully');
    }

    /**
     * Store a newly created RrhhUnidad in storage.
     * POST /rrhhUnidads
     *
     * @param CreateRrhhUnidadAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRrhhUnidadAPIRequest $request)
    {
        $input = $request->all();

        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::create($input);

        return $this->sendResponse($rrhhUnidad->toArray(), 'Rrhh Unidad guardado exitosamente');
    }

    /**
     * Display the specified RrhhUnidad.
     * GET|HEAD /rrhhUnidads/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            return $this->sendError('Rrhh Unidad no encontrado');
        }

        return $this->sendResponse($rrhhUnidad->toArray(), 'Rrhh Unidad retrieved successfully');
    }

    /**
     * Update the specified RrhhUnidad in storage.
     * PUT/PATCH /rrhhUnidads/{id}
     *
     * @param int $id
     * @param UpdateRrhhUnidadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRrhhUnidadAPIRequest $request)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            return $this->sendError('Rrhh Unidad no encontrado');
        }

        $rrhhUnidad->fill($request->all());
        $rrhhUnidad->save();

        return $this->sendResponse($rrhhUnidad->toArray(), 'RrhhUnidad actualizado con éxito');
    }

    /**
     * Remove the specified RrhhUnidad from storage.
     * DELETE /rrhhUnidads/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            return $this->sendError('Rrhh Unidad no encontrado');
        }

        $rrhhUnidad->delete();

        return $this->sendSuccess('Rrhh Unidad deleted successfully');
    }
}
