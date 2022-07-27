<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockInicialAPIRequest;
use App\Http\Requests\API\UpdateStockInicialAPIRequest;
use App\Models\StockInicial;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StockInicialController
 * @package App\Http\Controllers\API
 */

class StockInicialAPIController extends AppBaseController
{
    /**
     * Display a listing of the StockInicial.
     * GET|HEAD /stockInicials
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = StockInicial::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $stockInicials = $query->get();

        return $this->sendResponse($stockInicials->toArray(), 'Stock Inicials retrieved successfully');
    }

    /**
     * Store a newly created StockInicial in storage.
     * POST /stockInicials
     *
     * @param CreateStockInicialAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStockInicialAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::create($input);

        return $this->sendResponse($stockInicial->toArray(), 'Stock Inicial guardado exitosamente');
    }

    /**
     * Display the specified StockInicial.
     * GET|HEAD /stockInicials/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::find($id);

        if (empty($stockInicial)) {
            return $this->sendError('Stock Inicial no encontrado');
        }

        return $this->sendResponse($stockInicial->toArray(), 'Stock Inicial retrieved successfully');
    }

    /**
     * Update the specified StockInicial in storage.
     * PUT/PATCH /stockInicials/{id}
     *
     * @param int $id
     * @param UpdateStockInicialAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockInicialAPIRequest $request)
    {
        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::find($id);

        if (empty($stockInicial)) {
            return $this->sendError('Stock Inicial no encontrado');
        }

        $stockInicial->fill($request->all());
        $stockInicial->save();

        return $this->sendResponse($stockInicial->toArray(), 'StockInicial actualizado con éxito');
    }

    /**
     * Remove the specified StockInicial from storage.
     * DELETE /stockInicials/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::find($id);

        if (empty($stockInicial)) {
            return $this->sendError('Stock Inicial no encontrado');
        }

        $stockInicial->delete();

        return $this->sendSuccess('Stock Inicial deleted successfully');
    }
}
