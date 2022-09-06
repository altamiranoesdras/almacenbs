<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoTarjetaDetalleAPIRequest;
use App\Http\Requests\API\UpdateActivoTarjetaDetalleAPIRequest;
use App\Models\ActivoTarjetaDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoTarjetaDetalleController
 * @package App\Http\Controllers\API
 */

class ActivoTarjetaDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoTarjetaDetalle.
     * GET|HEAD /activoTarjetaDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoTarjetaDetalle::with(['activo.media']);

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        if ($request->tarjeta_id){
            $query->where('tarjeta_id',$request->tarjeta_id);
        }
        $activoTarjetaDetalles = $query->get();

        return $this->sendResponse($activoTarjetaDetalles->toArray(), 'Activo Tarjeta Detalles retrieved successfully');
    }

    /**
     * Store a newly created ActivoTarjetaDetalle in storage.
     * POST /activoTarjetaDetalles
     *
     * @param CreateActivoTarjetaDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaDetalleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::create($input);

        return $this->sendResponse($activoTarjetaDetalle->toArray(), 'Activo Tarjeta Detalle guardado exitosamente');
    }

    /**
     * Display the specified ActivoTarjetaDetalle.
     * GET|HEAD /activoTarjetaDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            return $this->sendError('Activo Tarjeta Detalle no encontrado');
        }

        return $this->sendResponse($activoTarjetaDetalle->toArray(), 'Activo Tarjeta Detalle retrieved successfully');
    }

    /**
     * Update the specified ActivoTarjetaDetalle in storage.
     * PUT/PATCH /activoTarjetaDetalles/{id}
     *
     * @param int $id
     * @param UpdateActivoTarjetaDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaDetalleAPIRequest $request)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            return $this->sendError('Activo Tarjeta Detalle no encontrado');
        }

        $activoTarjetaDetalle->fill($request->all());
        $activoTarjetaDetalle->save();

        return $this->sendResponse($activoTarjetaDetalle->toArray(), 'ActivoTarjetaDetalle actualizado con éxito');
    }

    /**
     * Remove the specified ActivoTarjetaDetalle from storage.
     * DELETE /activoTarjetaDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            return $this->sendError('Activo Tarjeta Detalle no encontrado');
        }

        $activoTarjetaDetalle->delete();

        return $this->sendSuccess('Activo Tarjeta Detalle deleted successfully');
    }
}
