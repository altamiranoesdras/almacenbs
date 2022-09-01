<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivoTarjetaAPIRequest;
use App\Http\Requests\API\UpdateActivoTarjetaAPIRequest;
use App\Models\ActivoTarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivoTarjetaController
 * @package App\Http\Controllers\API
 */

class ActivoTarjetaAPIController extends AppBaseController
{
    /**
     * Display a listing of the ActivoTarjeta.
     * GET|HEAD /activoTarjetas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ActivoTarjeta::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $activoTarjetas = $query->get();

        return $this->sendResponse($activoTarjetas->toArray(), 'Activo Tarjetas retrieved successfully');
    }

    /**
     * Store a newly created ActivoTarjeta in storage.
     * POST /activoTarjetas
     *
     * @param CreateActivoTarjetaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::create($input);

        return $this->sendResponse($activoTarjeta->toArray(), 'Activo Tarjeta guardado exitosamente');
    }

    /**
     * Display the specified ActivoTarjeta.
     * GET|HEAD /activoTarjetas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            return $this->sendError('Activo Tarjeta no encontrado');
        }

        return $this->sendResponse($activoTarjeta->toArray(), 'Activo Tarjeta retrieved successfully');
    }

    /**
     * Update the specified ActivoTarjeta in storage.
     * PUT/PATCH /activoTarjetas/{id}
     *
     * @param int $id
     * @param UpdateActivoTarjetaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaAPIRequest $request)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            return $this->sendError('Activo Tarjeta no encontrado');
        }

        $activoTarjeta->fill($request->all());
        $activoTarjeta->save();

        return $this->sendResponse($activoTarjeta->toArray(), 'ActivoTarjeta actualizado con éxito');
    }

    /**
     * Remove the specified ActivoTarjeta from storage.
     * DELETE /activoTarjetas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            return $this->sendError('Activo Tarjeta no encontrado');
        }

        $activoTarjeta->delete();

        return $this->sendSuccess('Activo Tarjeta deleted successfully');
    }
}
