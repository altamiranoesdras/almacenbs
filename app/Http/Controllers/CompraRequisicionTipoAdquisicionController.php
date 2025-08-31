<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequisicionTipoAdquisicionDataTable;
use App\Http\Requests\CreateCompraRequisicionTipoAdquisicionRequest;
use App\Http\Requests\UpdateCompraRequisicionTipoAdquisicionRequest;
use App\Models\CompraRequisicionTipoAdquisicion;

class CompraRequisicionTipoAdquisicionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicion Tipo adquisiciones')->only('show');
        $this->middleware('permission:Crear Compra Requisicion Tipo adquisiciones')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicion Tipo adquisiciones')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicion Tipo adquisiciones')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicionTipoAdquisicion.
     */
    public function index(CompraRequisicionTipoAdquisicionDataTable $compraRequisicionTipoAdquisicionDataTable)
    {
    return $compraRequisicionTipoAdquisicionDataTable->render('compra_requisicion_tipo_adquisiciones.index');

    }


    /**
     * Show the form for creating a new CompraRequisicionTipoAdquisicion.
     */
    public function create()
    {
        return view('compra_requisicion_tipo_adquisiciones.create');
    }

    /**
     * Store a newly created CompraRequisicionTipoAdquisicion in storage.
     */
    public function store(CreateCompraRequisicionTipoAdquisicionRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::create($input);

        flash()->success('Compra Requisicion Tipo Adquisicion guardado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }

    /**
     * Display the specified CompraRequisicionTipoAdquisicion.
     */
    public function show($id)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            flash()->error('Compra Requisicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        return view('compra_requisicion_tipo_adquisiciones.show')->with('compraRequisicionTipoAdquisicion', $compraRequisicionTipoAdquisicion);
    }

    /**
     * Show the form for editing the specified CompraRequisicionTipoAdquisicion.
     */
    public function edit($id)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            flash()->error('Compra Requisicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        return view('compra_requisicion_tipo_adquisiciones.edit')->with('compraRequisicionTipoAdquisicion', $compraRequisicionTipoAdquisicion);
    }

    /**
     * Update the specified CompraRequisicionTipoAdquisicion in storage.
     */
    public function update($id, UpdateCompraRequisicionTipoAdquisicionRequest $request)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            flash()->error('Compra Requisicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        $compraRequisicionTipoAdquisicion->fill($request->all());
        $compraRequisicionTipoAdquisicion->save();

        flash()->success('Compra Requisicion Tipo Adquisicion actualizado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }

    /**
     * Remove the specified CompraRequisicionTipoAdquisicion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequisicionTipoAdquisicion */
        $compraRequisicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequisicionTipoAdquisicion)) {
            flash()->error('Compra Requisicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        $compraRequisicionTipoAdquisicion->delete();

        flash()->success('Compra Requisicion Tipo Adquisicion eliminado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }
}
