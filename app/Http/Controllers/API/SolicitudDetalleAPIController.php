<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSolicitudDetalleAPIRequest;
use App\Http\Requests\API\UpdateSolicitudDetalleAPIRequest;
use App\Models\Item;
use App\Models\SolicitudDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SolicitudDetalleController
 * @package App\Http\Controllers\API
 */

class SolicitudDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the SolicitudDetalle.
     * GET|HEAD /solicitudDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = SolicitudDetalle::with(['item']);

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        if ($request->solicitud_id) {
            $query->where('solicitud_id',$request->solicitud_id);
        }

        $solicitudDetalles = $query->get();

        return $this->sendResponse($solicitudDetalles->toArray(), 'Solicitud Detalles retrieved successfully');
    }

    /**
     * Store a newly created SolicitudDetalle in storage.
     * POST /solicitudDetalles
     *
     * @param CreateSolicitudDetalleAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateSolicitudDetalleAPIRequest $request)
    {

        $item = Item::find($request->get('item_id'));
        if($item->categoria_id == null ){
            return $this->sendError('No se puede agregar insumos sin categoría');
        }

        if ($item->stock_unidad_almacen < $request->cantidad_solicitada) {
            return $this->sendError('No puedes pedir más del stock de tu unidad');
        }

        if ($request->cantidad_solicitada <= 0) {
            return $this->sendError('La cantidad solicitada debe ser mayor a cero');
        }

        $input = $request->all();

        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::create($input);

        return $this->sendResponse($solicitudDetalle->toArray(), 'Solicitud Detalle guardado exitosamente');
    }

    /**
     * Display the specified SolicitudDetalle.
     * GET|HEAD /solicitudDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            return $this->sendError('Solicitud Detalle no encontrado');
        }

        return $this->sendResponse($solicitudDetalle->toArray(), 'Solicitud Detalle retrieved successfully');
    }

    /**
     * Update the specified SolicitudDetalle in storage.
     * PUT/PATCH /solicitudDetalles/{id}
     *
     * @param int $id
     * @param UpdateSolicitudDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSolicitudDetalleAPIRequest $request)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            return $this->sendError('Solicitud Detalle no encontrado');
        }

        $solicitudDetalle->fill($request->all());
        $solicitudDetalle->save();

        return $this->sendResponse($solicitudDetalle->toArray(), 'SolicitudDetalle actualizado con éxito');
    }

    /**
     * Remove the specified SolicitudDetalle from storage.
     * DELETE /solicitudDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            return $this->sendError('Solicitud Detalle no encontrado');
        }

        $solicitudDetalle->delete();

        return $this->sendSuccess('Solicitud Detalle deleted successfully');
    }
}
