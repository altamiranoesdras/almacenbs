<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockTransaccionAPIRequest;
use App\Http\Requests\API\UpdateStockTransaccionAPIRequest;
use App\Models\StockTransaccion;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StockTransaccionController
 * @package App\Http\Controllers\API
 */

class StockTransaccionAPIController extends AppBaseController
{
    /**
     * Display a listing of the StockTransaccion.
     * GET|HEAD /stockTransaccions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = StockTransaccion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $stockTransaccions = $query->get();

        return $this->sendResponse($stockTransaccions->toArray(), 'Stock Transaccions retrieved successfully');
    }

    /**
     * Store a newly created StockTransaccion in storage.
     * POST /stockTransaccions
     *
     * @param CreateStockTransaccionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStockTransaccionAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::create($input);

        return $this->sendResponse($stockTransaccion->toArray(), 'Stock Transaccion guardado exitosamente');
    }

    /**
     * Display the specified StockTransaccion.
     * GET|HEAD /stockTransaccions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::find($id);

        if (empty($stockTransaccion)) {
            return $this->sendError('Stock Transaccion no encontrado');
        }

        return $this->sendResponse($stockTransaccion->toArray(), 'Stock Transaccion retrieved successfully');
    }

    /**
     * Update the specified StockTransaccion in storage.
     * PUT/PATCH /stockTransaccions/{id}
     *
     * @param int $id
     * @param UpdateStockTransaccionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockTransaccionAPIRequest $request)
    {
        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::find($id);

        if (empty($stockTransaccion)) {
            return $this->sendError('Stock Transaccion no encontrado');
        }

        $stockTransaccion->fill($request->all());
        $stockTransaccion->save();

        return $this->sendResponse($stockTransaccion->toArray(), 'StockTransaccion actualizado con éxito');
    }

    /**
     * Remove the specified StockTransaccion from storage.
     * DELETE /stockTransaccions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::find($id);

        if (empty($stockTransaccion)) {
            return $this->sendError('Stock Transaccion no encontrado');
        }

        $stockTransaccion->delete();

        return $this->sendSuccess('Stock Transaccion deleted successfully');
    }
}
