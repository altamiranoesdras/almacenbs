<?php

namespace App\Http\Controllers;

use App\DataTables\StockTransaccionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStockTransaccionRequest;
use App\Http\Requests\UpdateStockTransaccionRequest;
use App\Models\StockTransaccion;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StockTransaccionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Stock Transaccions')->only(['show']);
        $this->middleware('permission:Crear Stock Transaccions')->only(['create','store']);
        $this->middleware('permission:Editar Stock Transaccions')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Stock Transaccions')->only(['destroy']);
    }

    /**
     * Display a listing of the StockTransaccion.
     *
     * @param StockTransaccionDataTable $stockTransaccionDataTable
     * @return Response
     */
    public function index(StockTransaccionDataTable $stockTransaccionDataTable)
    {
        return $stockTransaccionDataTable->render('stock_transaccions.index');
    }

    /**
     * Show the form for creating a new StockTransaccion.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_transaccions.create');
    }

    /**
     * Store a newly created StockTransaccion in storage.
     *
     * @param CreateStockTransaccionRequest $request
     *
     * @return Response
     */
    public function store(CreateStockTransaccionRequest $request)
    {
        $input = $request->all();

        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::create($input);

        Flash::success('Stock Transaccion guardado exitosamente.');

        return redirect(route('stockTransaccions.index'));
    }

    /**
     * Display the specified StockTransaccion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::find($id);

        if (empty($stockTransaccion)) {
            Flash::error('Stock Transaccion no encontrado');

            return redirect(route('stockTransaccions.index'));
        }

        return view('stock_transaccions.show')->with('stockTransaccion', $stockTransaccion);
    }

    /**
     * Show the form for editing the specified StockTransaccion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::find($id);

        if (empty($stockTransaccion)) {
            Flash::error('Stock Transaccion no encontrado');

            return redirect(route('stockTransaccions.index'));
        }

        return view('stock_transaccions.edit')->with('stockTransaccion', $stockTransaccion);
    }

    /**
     * Update the specified StockTransaccion in storage.
     *
     * @param  int              $id
     * @param UpdateStockTransaccionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockTransaccionRequest $request)
    {
        /** @var StockTransaccion $stockTransaccion */
        $stockTransaccion = StockTransaccion::find($id);

        if (empty($stockTransaccion)) {
            Flash::error('Stock Transaccion no encontrado');

            return redirect(route('stockTransaccions.index'));
        }

        $stockTransaccion->fill($request->all());
        $stockTransaccion->save();

        Flash::success('Stock Transaccion actualizado con éxito.');

        return redirect(route('stockTransaccions.index'));
    }

    /**
     * Remove the specified StockTransaccion from storage.
     *
     * @param  int $id
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
            Flash::error('Stock Transaccion no encontrado');

            return redirect(route('stockTransaccions.index'));
        }

        $stockTransaccion->delete();

        Flash::success('Stock Transaccion deleted successfully.');

        return redirect(route('stockTransaccions.index'));
    }
}
