<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompra1hDetalleAPIRequest;
use App\Http\Requests\API\UpdateCompra1hDetalleAPIRequest;
use App\Models\Compra1hDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Compra1hDetalleController
 * @package App\Http\Controllers\API
 */

class Compra1hDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the Compra1hDetalle.
     * GET|HEAD /compra1hDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Compra1hDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compra1hDetalles = $query->get();

        return $this->sendResponse($compra1hDetalles->toArray(), 'Compra1H Detalles retrieved successfully');
    }

    /**
     * Store a newly created Compra1hDetalle in storage.
     * POST /compra1hDetalles
     *
     * @param CreateCompra1hDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCompra1hDetalleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::create($input);

        return $this->sendResponse($compra1hDetalle->toArray(), 'Compra1H Detalle guardado exitosamente');
    }

    /**
     * Display the specified Compra1hDetalle.
     * GET|HEAD /compra1hDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            return $this->sendError('Compra1H Detalle no encontrado');
        }

        return $this->sendResponse($compra1hDetalle->toArray(), 'Compra1H Detalle retrieved successfully');
    }

    /**
     * Update the specified Compra1hDetalle in storage.
     * PUT/PATCH /compra1hDetalles/{id}
     *
     * @param int $id
     * @param UpdateCompra1hDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompra1hDetalleAPIRequest $request)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            return $this->sendError('Compra1H Detalle no encontrado');
        }

        $compra1hDetalle->fill($request->all());
        $compra1hDetalle->save();

        return $this->sendResponse($compra1hDetalle->toArray(), 'Compra1hDetalle actualizado con éxito');
    }

    /**
     * Remove the specified Compra1hDetalle from storage.
     * DELETE /compra1hDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            return $this->sendError('Compra1H Detalle no encontrado');
        }

        $compra1hDetalle->delete();

        return $this->sendSuccess('Compra1H Detalle deleted successfully');
    }
}
