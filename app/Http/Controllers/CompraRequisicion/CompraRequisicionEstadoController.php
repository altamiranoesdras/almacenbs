<?php

namespace App\Http\Controllers\CompraRequisicion;

use App\DataTables\CompraRequisicion\CompraRequisicionEstadoDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Create\CompraRequisicion\CreateCompraRequisicionEstadoRequest;
use App\Http\Requests\Update\CompraRequisicion\UpdateCompraRequisicionEstadoRequest;
use App\Models\CompraRequisicion\CompraRequisicionEstado;

class CompraRequisicionEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicion Estados')->only('show');
        $this->middleware('permission:Crear Compra Requisicion Estados')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicion Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicion Estados')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicionEstado.
     */
    public function index(CompraRequisicionEstadoDataTable $compraRequisicionEstadoDataTable)
    {
    return $compraRequisicionEstadoDataTable->render('compra_requisicion_estados.index');
    }


    /**
     * Show the form for creating a new CompraRequisicionEstado.
     */
    public function create()
    {
        return view('compra_requisicion_estados.create');
    }

    /**
     * Store a newly created CompraRequisicionEstado in storage.
     */
    public function store(CreateCompraRequisicionEstadoRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::create($input);

        flash()->success('Compra Requisicion Estado guardado.');

        return redirect(route('compra.requisiciones.estados.index'));
    }

    /**
     * Display the specified CompraRequisicionEstado.
     */
    public function show($id)
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            flash()->error('Compra Requisicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        return view('compra_requisicion_estados.show')->with('compraRequisicionEstado', $compraRequisicionEstado);
    }

    /**
     * Show the form for editing the specified CompraRequisicionEstado.
     */
    public function edit($id)
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            flash()->error('Compra Requisicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        return view('compra_requisicion_estados.edit')->with('compraRequisicionEstado', $compraRequisicionEstado);
    }

    /**
     * Update the specified CompraRequisicionEstado in storage.
     */
    public function update($id, UpdateCompraRequisicionEstadoRequest $request)
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            flash()->error('Compra Requisicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        $compraRequisicionEstado->fill($request->all());
        $compraRequisicionEstado->save();

        flash()->success('Compra Requisicion Estado actualizado.');

        return redirect(route('compra.requisiciones.estados.index'));
    }

    /**
     * Remove the specified CompraRequisicionEstado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicionEstado $compraRequisicionEstado */
        $compraRequisicionEstado = CompraRequisicionEstado::find($id);

        if (empty($compraRequisicionEstado)) {
            flash()->error('Compra Requisicion Estado no encontrado');

            return redirect(route('compra.requisiciones.estados.index'));
        }

        $compraRequisicionEstado->delete();

        flash()->success('Compra Requisicion Estado eliminado.');

        return redirect(route('compra.requisiciones.estados.index'));
    }
}
