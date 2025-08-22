<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequicicionEstadoDataTable;
use App\Http\Requests\CreateCompraRequicicionEstadoRequest;
use App\Http\Requests\UpdateCompraRequicicionEstadoRequest;
use App\Models\CompraRequicicionEstado;

class CompraRequicicionEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requicicion Estados')->only('show');
        $this->middleware('permission:Crear Compra Requicicion Estados')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requicicion Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requicicion Estados')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequicicionEstado.
     */
    public function index(CompraRequicicionEstadoDataTable $compraRequicicionEstadoDataTable)
    {
    return $compraRequicicionEstadoDataTable->render('compra_requisicion_estados.index');
    }


    /**
     * Show the form for creating a new CompraRequicicionEstado.
     */
    public function create()
    {
        return view('compra_requisicion_estados.create');
    }

    /**
     * Store a newly created CompraRequicicionEstado in storage.
     */
    public function store(CreateCompraRequicicionEstadoRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::create($input);

        flash()->success('Compra Requicicion Estado guardado.');

        return redirect(route('compra.requisiciones.estados.index'));
    }

    /**
     * Display the specified CompraRequicicionEstado.
     */
    public function show($id)
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            flash()->error('Compra Requicicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        return view('compra_requisicion_estados.show')->with('compraRequisicionEstado', $compraRequicicionEstado);
    }

    /**
     * Show the form for editing the specified CompraRequicicionEstado.
     */
    public function edit($id)
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            flash()->error('Compra Requicicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        return view('compra_requisicion_estados.edit')->with('compraRequisicionEstado', $compraRequicicionEstado);
    }

    /**
     * Update the specified CompraRequicicionEstado in storage.
     */
    public function update($id, UpdateCompraRequicicionEstadoRequest $request)
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            flash()->error('Compra Requicicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        $compraRequicicionEstado->fill($request->all());
        $compraRequicicionEstado->save();

        flash()->success('Compra Requicicion Estado actualizado.');

        return redirect(route('compra.requisiciones.estados.index'));
    }

    /**
     * Remove the specified CompraRequicicionEstado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequicicionEstado $compraRequicicionEstado */
        $compraRequicicionEstado = CompraRequicicionEstado::find($id);

        if (empty($compraRequicicionEstado)) {
            flash()->error('Compra Requicicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        $compraRequicicionEstado->delete();

        flash()->success('Compra Requicicion Estado eliminado.');

        return redirect(route('compra.requisiciones.estados.index'));
    }
}
