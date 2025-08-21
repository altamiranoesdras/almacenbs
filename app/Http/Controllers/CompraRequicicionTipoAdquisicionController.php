<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequicicionTipoAdquisicionDataTable;
use App\Http\Requests\CreateCompraRequicicionTipoAdquisicionRequest;
use App\Http\Requests\UpdateCompraRequicicionTipoAdquisicionRequest;
use App\Models\CompraRequicicionTipoAdquisicion;

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
     * Display a listing of the CompraRequicicionTipoAdquisicion.
     */
    public function index(CompraRequicicionTipoAdquisicionDataTable $compraRequicicionTipoAdquisicionDataTable)
    {
    return $compraRequicicionTipoAdquisicionDataTable->render('compra_requisicion_tipo_adquisiciones.index');

    }


    /**
     * Show the form for creating a new CompraRequicicionTipoAdquisicion.
     */
    public function create()
    {
        return view('compra_requisicion_tipo_adquisiciones.create');
    }

    /**
     * Store a newly created CompraRequicicionTipoAdquisicion in storage.
     */
    public function store(CreateCompraRequicicionTipoAdquisicionRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::create($input);

        flash()->success('Compra Requicicion Tipo Adquisicion guardado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }

    /**
     * Display the specified CompraRequicicionTipoAdquisicion.
     */
    public function show($id)
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        return view('compra_requisicion_tipo_adquisiciones.show')->with('compraRequicicionTipoAdquisicion', $compraRequicicionTipoAdquisicion);
    }

    /**
     * Show the form for editing the specified CompraRequicicionTipoAdquisicion.
     */
    public function edit($id)
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        return view('compra_requisicion_tipo_adquisiciones.edit')->with('compraRequicicionTipoAdquisicion', $compraRequicicionTipoAdquisicion);
    }

    /**
     * Update the specified CompraRequicicionTipoAdquisicion in storage.
     */
    public function update($id, UpdateCompraRequicicionTipoAdquisicionRequest $request)
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

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
     * Remove the specified CompraRequicicionTipoAdquisicion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequicicionTipoAdquisicion $compraRequicicionTipoAdquisicion */
        $compraRequicicionTipoAdquisicion = CompraRequicicionTipoAdquisicion::find($id);

        if (empty($compraRequicicionTipoAdquisicion)) {
            flash()->error('Compra Requicicion Tipo Adquisicion no encontrado');

            return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
        }

        $compraRequicicionTipoAdquisicion->delete();

        flash()->success('Compra Requicicion Tipo Adquisicion eliminado.');

        return redirect(route('compra.requisiciones.tipo-adquisiciones.index'));
    }
}
