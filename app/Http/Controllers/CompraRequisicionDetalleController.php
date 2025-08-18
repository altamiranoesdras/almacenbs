<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequisicionDetalleDataTable;
use App\Http\Requests\CreateCompraRequisicionDetalleRequest;
use App\Http\Requests\UpdateCompraRequisicionDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraRequisicionDetalle;
use Illuminate\Http\Request;

class CompraRequisicionDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicion Detalles')->only('show');
        $this->middleware('permission:Crear Compra Requisicion Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicion Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicion Detalles')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicionDetalle.
     */
    public function index(CompraRequisicionDetalleDataTable $compraRequisicionDetalleDataTable)
    {
    return $compraRequisicionDetalleDataTable->render('compra_requisicion_detalles.index');
    }


    /**
     * Show the form for creating a new CompraRequisicionDetalle.
     */
    public function create()
    {
        return view('compra_requisicion_detalles.create');
    }

    /**
     * Store a newly created CompraRequisicionDetalle in storage.
     */
    public function store(CreateCompraRequisicionDetalleRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::create($input);

        flash()->success('Compra Requisicion Detalle guardado.');

        return redirect(route('compraRequisicionDetalles.index'));
    }

    /**
     * Display the specified CompraRequisicionDetalle.
     */
    public function show($id)
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            flash()->error('Compra Requisicion Detalle no encontrado');

            return redirect(route('compraRequisicionDetalles.index'));
        }

        return view('compra_requisicion_detalles.show')->with('compraRequisicionDetalle', $compraRequisicionDetalle);
    }

    /**
     * Show the form for editing the specified CompraRequisicionDetalle.
     */
    public function edit($id)
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            flash()->error('Compra Requisicion Detalle no encontrado');

            return redirect(route('compraRequisicionDetalles.index'));
        }

        return view('compra_requisicion_detalles.edit')->with('compraRequisicionDetalle', $compraRequisicionDetalle);
    }

    /**
     * Update the specified CompraRequisicionDetalle in storage.
     */
    public function update($id, UpdateCompraRequisicionDetalleRequest $request)
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            flash()->error('Compra Requisicion Detalle no encontrado');

            return redirect(route('compraRequisicionDetalles.index'));
        }

        $compraRequisicionDetalle->fill($request->all());
        $compraRequisicionDetalle->save();

        flash()->success('Compra Requisicion Detalle actualizado.');

        return redirect(route('compraRequisicionDetalles.index'));
    }

    /**
     * Remove the specified CompraRequisicionDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicionDetalle $compraRequisicionDetalle */
        $compraRequisicionDetalle = CompraRequisicionDetalle::find($id);

        if (empty($compraRequisicionDetalle)) {
            flash()->error('Compra Requisicion Detalle no encontrado');

            return redirect(route('compraRequisicionDetalles.index'));
        }

        $compraRequisicionDetalle->delete();

        flash()->success('Compra Requisicion Detalle eliminado.');

        return redirect(route('compraRequisicionDetalles.index'));
    }
}
