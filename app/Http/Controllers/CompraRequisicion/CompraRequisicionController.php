<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicionDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Create\CompraRequisicion\CreateCompraRequisicionRequest;
use App\Http\Requests\Update\UpdateCompraRequisicionRequest;
use App\Models\CompraRequisicion\CompraRequisicion;

class CompraRequisicionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicions')->only('show');
        $this->middleware('permission:Crear Compra Requisicions')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicions')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicions')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicion.
     */
    public function index(CompraRequisicionDataTable $compraRequisicionDataTable)
    {
    return $compraRequisicionDataTable->render('compra_requisicions.index');
    }


    /**
     * Show the form for creating a new CompraRequisicion.
     */
    public function create()
    {
        return view('compra_requisicions.create');
    }

    /**
     * Store a newly created CompraRequisicion in storage.
     */
    public function store(CreateCompraRequisicionRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::create($input);

        flash()->success('Compra Requisicion guardado.');

        return redirect(route('compraRequisicions.index'));
    }

    /**
     * Display the specified CompraRequisicion.
     */
    public function show($id)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compraRequisicions.index'));
        }

        return view('compra_requisicions.show')->with('compraRequisicion', $compraRequisicion);
    }

    /**
     * Show the form for editing the specified CompraRequisicion.
     */
    public function edit($id)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compraRequisicions.index'));
        }

        return view('compra_requisicions.edit')->with('compraRequisicion', $compraRequisicion);
    }

    /**
     * Update the specified CompraRequisicion in storage.
     */
    public function update($id, UpdateCompraRequisicionRequest $request)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compraRequisicions.index'));
        }

        $compraRequisicion->fill($request->all());
        $compraRequisicion->save();

        flash()->success('Compra Requisicion actualizado.');

        return redirect(route('compraRequisicions.index'));
    }

    /**
     * Remove the specified CompraRequisicion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicion $compraRequisicion */
        $compraRequisicion = CompraRequisicion::find($id);

        if (empty($compraRequisicion)) {
            flash()->error('Compra Requisicion no encontrado');

            return redirect(route('compraRequisicions.index'));
        }

        $compraRequisicion->delete();

        flash()->success('Compra Requisicion eliminado.');

        return redirect(route('compraRequisicions.index'));
    }
}
