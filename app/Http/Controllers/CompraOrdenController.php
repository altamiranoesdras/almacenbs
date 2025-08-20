<?php

namespace App\Http\Controllers;

use App\DataTables\CompraOrdenDataTable;
use App\Http\Requests\CreateCompraOrdenRequest;
use App\Http\Requests\UpdateCompraOrdenRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraOrden;
use Illuminate\Http\Request;

class CompraOrdenController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Ordens')->only('show');
        $this->middleware('permission:Crear Compra Ordens')->only(['create','store']);
        $this->middleware('permission:Editar Compra Ordens')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Ordens')->only('destroy');
    }
    /**
     * Display a listing of the CompraOrden.
     */
    public function index(CompraOrdenDataTable $compraOrdenDataTable)
    {
    return $compraOrdenDataTable->render('compra_ordens.index');
    }


    /**
     * Show the form for creating a new CompraOrden.
     */
    public function create()
    {
        return view('compra_ordens.create');
    }

    /**
     * Store a newly created CompraOrden in storage.
     */
    public function store(CreateCompraOrdenRequest $request)
    {
        $input = $request->all();

        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::create($input);

        flash()->success('Compra Orden guardado.');

        return redirect(route('compraOrdens.index'));
    }

    /**
     * Display the specified CompraOrden.
     */
    public function show($id)
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            flash()->error('Compra Orden no encontrado');

            return redirect(route('compraOrdens.index'));
        }

        return view('compra_ordens.show')->with('compraOrden', $compraOrden);
    }

    /**
     * Show the form for editing the specified CompraOrden.
     */
    public function edit($id)
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            flash()->error('Compra Orden no encontrado');

            return redirect(route('compraOrdens.index'));
        }

        return view('compra_ordens.edit')->with('compraOrden', $compraOrden);
    }

    /**
     * Update the specified CompraOrden in storage.
     */
    public function update($id, UpdateCompraOrdenRequest $request)
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            flash()->error('Compra Orden no encontrado');

            return redirect(route('compraOrdens.index'));
        }

        $compraOrden->fill($request->all());
        $compraOrden->save();

        flash()->success('Compra Orden actualizado.');

        return redirect(route('compraOrdens.index'));
    }

    /**
     * Remove the specified CompraOrden from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraOrden $compraOrden */
        $compraOrden = CompraOrden::find($id);

        if (empty($compraOrden)) {
            flash()->error('Compra Orden no encontrado');

            return redirect(route('compraOrdens.index'));
        }

        $compraOrden->delete();

        flash()->success('Compra Orden eliminado.');

        return redirect(route('compraOrdens.index'));
    }
}
