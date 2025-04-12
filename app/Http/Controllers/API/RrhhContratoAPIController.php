<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRrhhContratoAPIRequest;
use App\Http\Requests\API\UpdateRrhhContratoAPIRequest;
use App\Models\RrhhContrato;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RrhhContratoController
 * @package App\Http\Controllers\API
 */

class RrhhContratoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RrhhContrato.
     * GET|HEAD /rrhhContratos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = RrhhContrato::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $rrhhContratos = $query->get();

        return $this->sendResponse($rrhhContratos->toArray(), 'Rrhh Contratos retrieved successfully');
    }

    /**
     * Store a newly created RrhhContrato in storage.
     * POST /rrhhContratos
     *
     * @param CreateRrhhContratoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRrhhContratoAPIRequest $request)
    {
        $input = $request->all();

        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::create($input);

        return $this->sendResponse($rrhhContrato->toArray(), 'Rrhh Contrato guardado exitosamente');
    }

    /**
     * Display the specified RrhhContrato.
     * GET|HEAD /rrhhContratos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            return $this->sendError('Rrhh Contrato no encontrado');
        }

        return $this->sendResponse($rrhhContrato->toArray(), 'Rrhh Contrato retrieved successfully');
    }

    /**
     * Update the specified RrhhContrato in storage.
     * PUT/PATCH /rrhhContratos/{id}
     *
     * @param int $id
     * @param UpdateRrhhContratoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRrhhContratoAPIRequest $request)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            return $this->sendError('Rrhh Contrato no encontrado');
        }

        $rrhhContrato->fill($request->all());
        $rrhhContrato->save();

        return $this->sendResponse($rrhhContrato->toArray(), 'RrhhContrato actualizado con éxito');
    }

    /**
     * Remove the specified RrhhContrato from storage.
     * DELETE /rrhhContratos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            return $this->sendError('Rrhh Contrato no encontrado');
        }

        $rrhhContrato->delete();

        return $this->sendSuccess('Rrhh Contrato deleted successfully');
    }
}
