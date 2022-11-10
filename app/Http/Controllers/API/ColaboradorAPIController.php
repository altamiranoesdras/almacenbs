<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateColaboradorAPIRequest;
use App\Http\Requests\API\UpdateColaboradorAPIRequest;
use App\Models\Colaborador;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ColaboradorController
 * @package App\Http\Controllers\API
 */

class ColaboradorAPIController extends AppBaseController
{
    /**
     * Display a listing of the Colaborador.
     * GET|HEAD /colaboradors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Colaborador::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $colaboradors = $query->get();

        return $this->sendResponse($colaboradors->toArray(), 'Colaboradors retrieved successfully');
    }

    /**
     * Store a newly created Colaborador in storage.
     * POST /colaboradors
     *
     * @param CreateColaboradorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateColaboradorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::create($input);

        return $this->sendResponse($colaborador->toArray(), 'Colaborador guardado exitosamente');
    }

    /**
     * Display the specified Colaborador.
     * GET|HEAD /colaboradors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            return $this->sendError('Colaborador no encontrado');
        }

        return $this->sendResponse($colaborador->toArray(), 'Colaborador retrieved successfully');
    }

    /**
     * Update the specified Colaborador in storage.
     * PUT/PATCH /colaboradors/{id}
     *
     * @param int $id
     * @param UpdateColaboradorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateColaboradorAPIRequest $request)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            return $this->sendError('Colaborador no encontrado');
        }

        $colaborador->fill($request->all());
        $colaborador->save();

        return $this->sendResponse($colaborador->toArray(), 'Colaborador actualizado con éxito');
    }

    /**
     * Remove the specified Colaborador from storage.
     * DELETE /colaboradors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            return $this->sendError('Colaborador no encontrado');
        }

        $colaborador->delete();

        return $this->sendSuccess('Colaborador deleted successfully');
    }
}
