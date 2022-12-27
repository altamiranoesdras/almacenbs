<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConsumoDetalleAPIRequest;
use App\Http\Requests\API\UpdateConsumoDetalleAPIRequest;
use App\Models\ConsumoDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConsumoDetalleController
 * @package App\Http\Controllers\API
 */

class ConsumoDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the ConsumoDetalle.
     * GET|HEAD /consumoDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ConsumoDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $consumoDetalles = $query->get();

        return $this->sendResponse($consumoDetalles->toArray(), 'Consumo Detalles retrieved successfully');
    }

    /**
     * Store a newly created ConsumoDetalle in storage.
     * POST /consumoDetalles
     *
     * @param CreateConsumoDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConsumoDetalleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ConsumoDetalle $consumoDetalle */
        $consumoDetalle = ConsumoDetalle::create($input);

        return $this->sendResponse($consumoDetalle->toArray(), 'Consumo Detalle guardado exitosamente');
    }

    /**
     * Display the specified ConsumoDetalle.
     * GET|HEAD /consumoDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ConsumoDetalle $consumoDetalle */
        $consumoDetalle = ConsumoDetalle::find($id);

        if (empty($consumoDetalle)) {
            return $this->sendError('Consumo Detalle no encontrado');
        }

        return $this->sendResponse($consumoDetalle->toArray(), 'Consumo Detalle retrieved successfully');
    }

    /**
     * Update the specified ConsumoDetalle in storage.
     * PUT/PATCH /consumoDetalles/{id}
     *
     * @param int $id
     * @param UpdateConsumoDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConsumoDetalleAPIRequest $request)
    {
        /** @var ConsumoDetalle $consumoDetalle */
        $consumoDetalle = ConsumoDetalle::find($id);

        if (empty($consumoDetalle)) {
            return $this->sendError('Consumo Detalle no encontrado');
        }

        $consumoDetalle->fill($request->all());
        $consumoDetalle->save();

        return $this->sendResponse($consumoDetalle->toArray(), 'ConsumoDetalle actualizado con éxito');
    }

    /**
     * Remove the specified ConsumoDetalle from storage.
     * DELETE /consumoDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ConsumoDetalle $consumoDetalle */
        $consumoDetalle = ConsumoDetalle::find($id);

        if (empty($consumoDetalle)) {
            return $this->sendError('Consumo Detalle no encontrado');
        }

        $consumoDetalle->delete();

        return $this->sendSuccess('Consumo Detalle deleted successfully');
    }
}
