<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConsumoEstadoAPIRequest;
use App\Http\Requests\API\UpdateConsumoEstadoAPIRequest;
use App\Models\ConsumoEstado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConsumoEstadoController
 * @package App\Http\Controllers\API
 */

class ConsumoEstadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ConsumoEstado.
     * GET|HEAD /consumoEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ConsumoEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $consumoEstados = $query->get();

        return $this->sendResponse($consumoEstados->toArray(), 'Consumo Estados retrieved successfully');
    }

    /**
     * Store a newly created ConsumoEstado in storage.
     * POST /consumoEstados
     *
     * @param CreateConsumoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConsumoEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::create($input);

        return $this->sendResponse($consumoEstado->toArray(), 'Consumo Estado guardado exitosamente');
    }

    /**
     * Display the specified ConsumoEstado.
     * GET|HEAD /consumoEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            return $this->sendError('Consumo Estado no encontrado');
        }

        return $this->sendResponse($consumoEstado->toArray(), 'Consumo Estado retrieved successfully');
    }

    /**
     * Update the specified ConsumoEstado in storage.
     * PUT/PATCH /consumoEstados/{id}
     *
     * @param int $id
     * @param UpdateConsumoEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConsumoEstadoAPIRequest $request)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            return $this->sendError('Consumo Estado no encontrado');
        }

        $consumoEstado->fill($request->all());
        $consumoEstado->save();

        return $this->sendResponse($consumoEstado->toArray(), 'ConsumoEstado actualizado con éxito');
    }

    /**
     * Remove the specified ConsumoEstado from storage.
     * DELETE /consumoEstados/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            return $this->sendError('Consumo Estado no encontrado');
        }

        $consumoEstado->delete();

        return $this->sendSuccess('Consumo Estado deleted successfully');
    }
}
