<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConsumoAPIRequest;
use App\Http\Requests\API\UpdateConsumoAPIRequest;
use App\Models\Consumo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConsumoController
 * @package App\Http\Controllers\API
 */

class ConsumoAPIController extends AppBaseController
{
    /**
     * Display a listing of the Consumo.
     * GET|HEAD /consumos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Consumo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $consumos = $query->get();

        return $this->sendResponse($consumos->toArray(), 'Consumos retrieved successfully');
    }

    /**
     * Store a newly created Consumo in storage.
     * POST /consumos
     *
     * @param CreateConsumoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConsumoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Consumo $consumo */
        $consumo = Consumo::create($input);

        return $this->sendResponse($consumo->toArray(), 'Consumo guardado exitosamente');
    }

    /**
     * Display the specified Consumo.
     * GET|HEAD /consumos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            return $this->sendError('Consumo no encontrado');
        }

        return $this->sendResponse($consumo->toArray(), 'Consumo retrieved successfully');
    }

    /**
     * Update the specified Consumo in storage.
     * PUT/PATCH /consumos/{id}
     *
     * @param int $id
     * @param UpdateConsumoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConsumoAPIRequest $request)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            return $this->sendError('Consumo no encontrado');
        }

        $consumo->fill($request->all());
        $consumo->save();

        return $this->sendResponse($consumo->toArray(), 'Consumo actualizado con éxito');
    }

    /**
     * Remove the specified Consumo from storage.
     * DELETE /consumos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            return $this->sendError('Consumo no encontrado');
        }

        $consumo->delete();

        return $this->sendSuccess('Consumo deleted successfully');
    }
}
