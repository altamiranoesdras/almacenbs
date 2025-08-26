<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequicicionTipoAdquisicionDataTable;
use App\Http\Requests\CreateCompraRequicicionTipoAdquisicionRequest;
use App\Http\Requests\UpdateCompraRequicicionTipoAdquisicionRequest;
use App\Models\CompraRequisicionTipoAdquisicion;

class CompraRequicicionTipoAdquisicionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requicicion Tipo adquisiciones')->only('show');
        $this->middleware('permission:Crear Compra Requicicion Tipo adquisiciones')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requicicion Tipo adquisiciones')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requicicion Tipo adquisiciones')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicionTipoAdquisicion.
     */
    public function index(CompraRequicicionTipoAdquisicionDataTable $compraRequicicionTipoAdquisicionDataTable)
    {
    return $compraRequicicionTipoAdquisicionDataTable->render('compra_requisicion_tipo_adquisiciones.index');

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
    public function store(CreateCompraRequicicionTipoAdquisicionRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::create($input);

        flash()->success('Compra Requicicion Tipo Adquisicion guardado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }

    /**
     * Display the specified CompraRequisicionTipoAdquisicion.
     */
    public function show($id)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        return view('compra_requisicion_tipo_adquisiciones.show')->with('compraRequicicionTipoAdquisicion', $compraRequicicionTipoAdquisicion);
    }

    /**
     * Show the form for editing the specified CompraRequisicionTipoAdquisicion.
     */
    public function edit($id)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        return view('compra_requisicion_tipo_adquisiciones.edit')->with('compraRequicicionTipoAdquisicion', $compraRequicicionTipoAdquisicion);
    }

    /**
     * Update the specified CompraRequisicionTipoAdquisicion in storage.
     */
    public function update($id, UpdateCompraRequicicionTipoAdquisicionRequest $request)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        $compraRequicicionTipoAdquisicion->fill($request->all());
        $compraRequicicionTipoAdquisicion->save();

        flash()->success('Compra Requicicion Tipo Adquisicion actualizado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }

    /**
     * Remove the specified CompraRequisicionTipoAdquisicion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequisicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        $compraRequicicionTipoAdquisicion->delete();

        flash()->success('Compra Requicicion Tipo Adquisicion eliminado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }
}
