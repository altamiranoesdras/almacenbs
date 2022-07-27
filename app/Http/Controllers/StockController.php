<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Stock;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StockController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Stocks')->only(['show']);
        $this->middleware('permission:Crear Stocks')->only(['create','store']);
        $this->middleware('permission:Editar Stocks')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Stocks')->only(['destroy']);
    }

    /**
     * Display a listing of the Stock.
     *
     * @param StockDataTable $stockDataTable
     * @return Response
     */
    public function index(StockDataTable $stockDataTable)
    {
        return $stockDataTable->render('stocks.index');
    }

    /**
     * Show the form for creating a new Stock.
     *
     * @return Response
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created Stock in storage.
     *
     * @param CreateStockRequest $request
     *
     * @return Response
     */
    public function store(CreateStockRequest $request)
    {
        $input = $request->all();

        /** @var Stock $stock */
        $stock = Stock::create($input);

        Flash::success('Stock guardado exitosamente.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Stock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Stock $stock */
        $stock = Stock::find($id);

        if (empty($stock)) {
            Flash::error('Stock no encontrado');

            return redirect(route('stocks.index'));
        }

        return view('stocks.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified Stock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Stock $stock */
        $stock = Stock::find($id);

        if (empty($stock)) {
            Flash::error('Stock no encontrado');

            return redirect(route('stocks.index'));
        }

        return view('stocks.edit')->with('stock', $stock);
    }

    /**
     * Update the specified Stock in storage.
     *
     * @param  int              $id
     * @param UpdateStockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockRequest $request)
    {
        /** @var Stock $stock */
        $stock = Stock::find($id);

        if (empty($stock)) {
            Flash::error('Stock no encontrado');

            return redirect(route('stocks.index'));
        }

        $stock->fill($request->all());
        $stock->save();

        Flash::success('Stock actualizado con éxito.');

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Stock from storage.
     *
     * @param  int $id
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
            Flash::error('Stock no encontrado');

            return redirect(route('stocks.index'));
        }

        $stock->delete();

        Flash::success('Stock deleted successfully.');

        return redirect(route('stocks.index'));
    }
}
