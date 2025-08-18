<?php

namespace App\Http\Controllers;

use App\DataTables\CompraOrdenDetalleDataTable;
use App\Http\Requests\CreateCompraOrdenDetalleRequest;
use App\Http\Requests\UpdateCompraOrdenDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraOrdenDetalle;
use Illuminate\Http\Request;

class CompraOrdenDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Orden Detalles')->only('show');
        $this->middleware('permission:Crear Compra Orden Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Compra Orden Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Orden Detalles')->only('destroy');
    }
    /**
     * Display a listing of the CompraOrdenDetalle.
     */
    public function index(CompraOrdenDetalleDataTable $compraOrdenDetalleDataTable)
    {
    return $compraOrdenDetalleDataTable->render('compra_orden_detalles.index');
    }


    /**
     * Show the form for creating a new CompraOrdenDetalle.
     */
    public function create()
    {
        return view('compra_orden_detalles.create');
    }

    /**
     * Store a newly created CompraOrdenDetalle in storage.
     */
    public function store(CreateCompraOrdenDetalleRequest $request)
    {
        $input = $request->all();

        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::create($input);

        flash()->success('Compra Orden Detalle guardado.');

        return redirect(route('compraOrdenDetalles.index'));
    }

    /**
     * Display the specified CompraOrdenDetalle.
     */
    public function show($id)
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            flash()->error('Compra Orden Detalle no encontrado');

            return redirect(route('compraOrdenDetalles.index'));
        }

        return view('compra_orden_detalles.show')->with('compraOrdenDetalle', $compraOrdenDetalle);
    }

    /**
     * Show the form for editing the specified CompraOrdenDetalle.
     */
    public function edit($id)
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            flash()->error('Compra Orden Detalle no encontrado');

            return redirect(route('compraOrdenDetalles.index'));
        }

        return view('compra_orden_detalles.edit')->with('compraOrdenDetalle', $compraOrdenDetalle);
    }

    /**
     * Update the specified CompraOrdenDetalle in storage.
     */
    public function update($id, UpdateCompraOrdenDetalleRequest $request)
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            flash()->error('Compra Orden Detalle no encontrado');

            return redirect(route('compraOrdenDetalles.index'));
        }

        $compraOrdenDetalle->fill($request->all());
        $compraOrdenDetalle->save();

        flash()->success('Compra Orden Detalle actualizado.');

        return redirect(route('compraOrdenDetalles.index'));
    }

    /**
     * Remove the specified CompraOrdenDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraOrdenDetalle $compraOrdenDetalle */
        $compraOrdenDetalle = CompraOrdenDetalle::find($id);

        if (empty($compraOrdenDetalle)) {
            flash()->error('Compra Orden Detalle no encontrado');

            return redirect(route('compraOrdenDetalles.index'));
        }

        $compraOrdenDetalle->delete();

        flash()->success('Compra Orden Detalle eliminado.');

        return redirect(route('compraOrdenDetalles.index'));
    }
}
