<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContratoAPIRequest;
use App\Http\Requests\API\UpdateContratoAPIRequest;
use App\Models\Contrato;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ContratoController
 * @package App\Http\Controllers\API
 */

class ContratoAPIController extends AppBaseController
{
    /**
     * Display a listing of the Contrato.
     * GET|HEAD /contratos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Contrato::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $contratos = $query->get();

        return $this->sendResponse($contratos->toArray(), 'Contratos retrieved successfully');
    }

    /**
     * Store a newly created Contrato in storage.
     * POST /contratos
     *
     * @param CreateContratoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContratoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Contrato $contrato */
        $contrato = Contrato::create($input);

        return $this->sendResponse($contrato->toArray(), 'Contrato guardado exitosamente');
    }

    /**
     * Display the specified Contrato.
     * GET|HEAD /contratos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Contrato $contrato */
        $contrato = Contrato::find($id);

        if (empty($contrato)) {
            return $this->sendError('Contrato no encontrado');
        }

        return $this->sendResponse($contrato->toArray(), 'Contrato retrieved successfully');
    }

    /**
     * Update the specified Contrato in storage.
     * PUT/PATCH /contratos/{id}
     *
     * @param int $id
     * @param UpdateContratoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContratoAPIRequest $request)
    {
        /** @var Contrato $contrato */
        $contrato = Contrato::find($id);

        if (empty($contrato)) {
            return $this->sendError('Contrato no encontrado');
        }

        $contrato->fill($request->all());
        $contrato->save();

        return $this->sendResponse($contrato->toArray(), 'Contrato actualizado con éxito');
    }

    /**
     * Remove the specified Contrato from storage.
     * DELETE /contratos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Contrato $contrato */
        $contrato = Contrato::find($id);

        if (empty($contrato)) {
            return $this->sendError('Contrato no encontrado');
        }

        $contrato->delete();

        return $this->sendSuccess('Contrato deleted successfully');
    }
}
