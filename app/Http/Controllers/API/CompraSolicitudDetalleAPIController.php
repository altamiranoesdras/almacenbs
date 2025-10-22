<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Models\CompraSolicitudDetalle;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraSolicitudDetalleAPIRequest;
use App\Http\Requests\API\UpdateCompraSolicitudDetalleAPIRequest;

/**
 * Class CompraSolicitudDetalleAPIController
 */
class CompraSolicitudDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraSolicitudDetalles.
     * GET|HEAD /compra-solicitud-detalles
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraSolicitudDetalle::with('item');

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        if ($request->get('solicitud_id')) {
            $query->where('solicitud_id', $request->get('solicitud_id'));
        }

        $compraSolicitudDetalles = $query->get();

        return $this->sendResponse($compraSolicitudDetalles->toArray(), 'Detalles ');
    }

    /**
     * Store a newly created CompraSolicitudDetalle in storage.
     * POST /compra-solicitud-detalles
     */
    public function store(CreateCompraSolicitudDetalleAPIRequest $request): JsonResponse
    {

        $request->validate([
            'item_id' => [
                'required',
                'integer',
                Rule::exists('items', 'id')
                ->whereNotNull('categoria_id')
            ],
            [
                'item_id.exists' => 'El Producto no tiene categoría asignada o no existe.',
            ]
        ]);

        $request->merge([
            'precio_venta' => $request->get('precio_venta') ?? 0,
        ]);

        $input = $request->all();

        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::create($input);

        return $this->sendResponse($compraSolicitudDetalle->toArray(), 'Detalle agregado');
    }

    /**
     * Display the specified CompraSolicitudDetalle.
     * GET|HEAD /compra-solicitud-detalles/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            return $this->sendError('Detalle no encontrado');
        }

        return $this->sendResponse($compraSolicitudDetalle->toArray(), 'Detalle ');
    }

    /**
     * Update the specified CompraSolicitudDetalle in storage.
     * PUT/PATCH /compra-solicitud-detalles/{id}
     */
    public function update($id, UpdateCompraSolicitudDetalleAPIRequest $request): JsonResponse
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            return $this->sendError('Detalle no encontrado');
        }

        $compraSolicitudDetalle->fill($request->all());
        $compraSolicitudDetalle->save();

        return $this->sendResponse($compraSolicitudDetalle->toArray(), 'Detalle actualizado');
    }

    /**
     * Remove the specified CompraSolicitudDetalle from storage.
     * DELETE /compra-solicitud-detalles/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            return $this->sendError('Detalle no encontrado');
        }

        $compraSolicitudDetalle->delete();

        return $this->sendSuccess('Detalle eliminado');
    }
}
