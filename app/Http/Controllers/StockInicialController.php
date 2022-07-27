<?php

namespace App\Http\Controllers;

use App\DataTables\StockInicialDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStockInicialRequest;
use App\Http\Requests\UpdateStockInicialRequest;
use App\Models\StockInicial;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StockInicialController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Stock Inicials')->only(['show']);
        $this->middleware('permission:Crear Stock Inicials')->only(['create','store']);
        $this->middleware('permission:Editar Stock Inicials')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Stock Inicials')->only(['destroy']);
    }

    /**
     * Display a listing of the StockInicial.
     *
     * @param StockInicialDataTable $stockInicialDataTable
     * @return Response
     */
    public function index(StockInicialDataTable $stockInicialDataTable)
    {
        return $stockInicialDataTable->render('stock_inicials.index');
    }

    /**
     * Show the form for creating a new StockInicial.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_inicials.create');
    }

    /**
     * Store a newly created StockInicial in storage.
     *
     * @param CreateStockInicialRequest $request
     *
     * @return Response
     */
    public function store(CreateStockInicialRequest $request)
    {
        $input = $request->all();

        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::create($input);

        Flash::success('Stock Inicial guardado exitosamente.');

        return redirect(route('stockInicials.index'));
    }

    /**
     * Display the specified StockInicial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::find($id);

        if (empty($stockInicial)) {
            Flash::error('Stock Inicial no encontrado');

            return redirect(route('stockInicials.index'));
        }

        return view('stock_inicials.show')->with('stockInicial', $stockInicial);
    }

    /**
     * Show the form for editing the specified StockInicial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::find($id);

        if (empty($stockInicial)) {
            Flash::error('Stock Inicial no encontrado');

            return redirect(route('stockInicials.index'));
        }

        return view('stock_inicials.edit')->with('stockInicial', $stockInicial);
    }

    /**
     * Update the specified StockInicial in storage.
     *
     * @param  int              $id
     * @param UpdateStockInicialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockInicialRequest $request)
    {
        /** @var StockInicial $stockInicial */
        $stockInicial = StockInicial::find($id);

        if (empty($stockInicial)) {
            Flash::error('Stock Inicial no encontrado');

            return redirect(route('stockInicials.index'));
        }

        $stockInicial->fill($request->all());
        $stockInicial->save();

        Flash::success('Stock Inicial actualizado con éxito.');

        return redirect(route('stockInicials.index'));
    }

    /**
     * Remove the specified StockInicial from storage.
     *
     * @param  int $id
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
            Flash::error('Stock Inicial no encontrado');

            return redirect(route('stockInicials.index'));
        }

        $stockInicial->delete();

        Flash::success('Stock Inicial deleted successfully.');

        return redirect(route('stockInicials.index'));
    }
}
