<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockAPIRequest;
use App\Http\Requests\API\UpdateStockAPIRequest;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StockController
 * @package App\Http\Controllers\API
 */

class StockAPIController extends AppBaseController
{
    /**
     * Display a listing of the Stock.
     * GET|HEAD /stocks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Stock::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $stocks = $query->get();

        return $this->sendResponse($stocks->toArray(), 'Stocks retrieved successfully');
    }

    /**
     * Store a newly created Stock in storage.
     * POST /stocks
     *
     * @param CreateStockAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAPIRequest $request)
    {
        $input = $request->all();

        /** @var Stock $stock */
        $stock = Stock::create($input);

        return $this->sendResponse($stock->toArray(), 'Stock guardado exitosamente');
    }

    /**
     * Display the specified Stock.
     * GET|HEAD /stocks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Stock $stock */
        $stock = Stock::find($id);

        if (empty($stock)) {
            return $this->sendError('Stock no encontrado');
        }

        return $this->sendResponse($stock->toArray(), 'Stock retrieved successfully');
    }

    /**
     * Update the specified Stock in storage.
     * PUT/PATCH /stocks/{id}
     *
     * @param int $id
     * @param UpdateStockAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAPIRequest $request)
    {
        /** @var Stock $stock */
        $stock = Stock::find($id);

        if (empty($stock)) {
            return $this->sendError('Stock no encontrado');
        }

        $stock->fill($request->all());
        $stock->save();

        return $this->sendResponse($stock->toArray(), 'Stock actualizado con éxito');
    }

    /**
     * Remove the specified Stock from storage.
     * DELETE /stocks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Stock $stock */
        $stock = Stock::find($id);

        if (empty($stock)) {
            return $this->sendError('Stock no encontrado');
        }

        $stock->delete();

        return $this->sendSuccess('Stock deleted successfully');
    }
}
