<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRrhhPuestoAPIRequest;
use App\Http\Requests\API\UpdateRrhhPuestoAPIRequest;
use App\Models\RrhhPuesto;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RrhhPuestoController
 * @package App\Http\Controllers\API
 */

class RrhhPuestoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RrhhPuesto.
     * GET|HEAD /rrhhPuestos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = RrhhPuesto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $rrhhPuestos = $query->get();

        return $this->sendResponse($rrhhPuestos->toArray(), 'Rrhh Puestos retrieved successfully');
    }

    /**
     * Store a newly created RrhhPuesto in storage.
     * POST /rrhhPuestos
     *
     * @param CreateRrhhPuestoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRrhhPuestoAPIRequest $request)
    {
        $input = $request->all();

        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::create($input);

        return $this->sendResponse($rrhhPuesto->toArray(), 'Rrhh Puesto guardado exitosamente');
    }

    /**
     * Display the specified RrhhPuesto.
     * GET|HEAD /rrhhPuestos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            return $this->sendError('Rrhh Puesto no encontrado');
        }

        return $this->sendResponse($rrhhPuesto->toArray(), 'Rrhh Puesto retrieved successfully');
    }

    /**
     * Update the specified RrhhPuesto in storage.
     * PUT/PATCH /rrhhPuestos/{id}
     *
     * @param int $id
     * @param UpdateRrhhPuestoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRrhhPuestoAPIRequest $request)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            return $this->sendError('Rrhh Puesto no encontrado');
        }

        $rrhhPuesto->fill($request->all());
        $rrhhPuesto->save();

        return $this->sendResponse($rrhhPuesto->toArray(), 'RrhhPuesto actualizado con éxito');
    }

    /**
     * Remove the specified RrhhPuesto from storage.
     * DELETE /rrhhPuestos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            return $this->sendError('Rrhh Puesto no encontrado');
        }

        $rrhhPuesto->delete();

        return $this->sendSuccess('Rrhh Puesto deleted successfully');
    }
}
