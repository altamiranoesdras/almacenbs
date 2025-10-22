<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\CompraDetalle;
use Illuminate\Validation\Rule;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCompraDetalleAPIRequest;
use App\Http\Requests\API\UpdateCompraDetalleAPIRequest;

/**
 * Class CompraDetalleController
 * @package App\Http\Controllers\API
 */

class CompraDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraDetalle.
     * GET|HEAD /compraDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = CompraDetalle::with(['item','unidadSolicitante']);

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }


        if ($request->compra_id) {
            $query->where('compra_id',$request->compra_id);
        }

        $compraDetalles = $query->get();

        return $this->sendResponse($compraDetalles->toArray(), 'Compra Detalles retrieved successfully');
    }

    /**
     * Store a newly created CompraDetalle in storage.
     * POST /compraDetalles
     *
     * @param CreateCompraDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCompraDetalleAPIRequest $request)
    {
        
        $item = Item::find($request->get('item_id'));
        if($item->categoria_id == null ){
            return $this->sendError('No se puede agregar insumos sin Catecoria');
        }

        $input = $request->all();

        /** @var CompraDetalle $compraDetalle */
        $compraDetalle = CompraDetalle::create($input);

        return $this->sendResponse($compraDetalle->toArray(), 'Detalle agregado!');
    }

    /**
     * Display the specified CompraDetalle.
     * GET|HEAD /compraDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CompraDetalle $compraDetalle */
        $compraDetalle = CompraDetalle::find($id);

        if (empty($compraDetalle)) {
            return $this->sendError('Detalle no encontrado');
        }

        return $this->sendResponse($compraDetalle->toArray(), 'Compra Detalle retrieved successfully');
    }

    /**
     * Update the specified CompraDetalle in storage.
     * PUT/PATCH /compraDetalles/{id}
     *
     * @param int $id
     * @param UpdateCompraDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompraDetalleAPIRequest $request)
    {
        /** @var CompraDetalle $compraDetalle */
        $compraDetalle = CompraDetalle::find($id);

        if (empty($compraDetalle)) {
            return $this->sendError('Detalle no encontrado');
        }

        $compraDetalle->fill($request->all());
        $compraDetalle->save();

        return $this->sendResponse($compraDetalle->toArray(), 'CompraDetalle actualizado con éxito');
    }

    /**
     * Remove the specified CompraDetalle from storage.
     * DELETE /compraDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CompraDetalle $compraDetalle */
        $compraDetalle = CompraDetalle::find($id);

        if (empty($compraDetalle)) {
            return $this->sendError('Detalle no encontrado');
        }

        $compraDetalle->delete();

        return $this->sendSuccess('Detalle eliminado!');
    }
}
