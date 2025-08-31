<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequisicionProcesoTipoDataTable;
use App\Http\Requests\CreateCompraRequisicionProcesoTipoRequest;
use App\Http\Requests\UpdateCompraRequisicionProcesoTipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraRequisicionProcesoTipo;
use Illuminate\Http\Request;

class CompraRequisicionProcesoTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicion Proceso Tipos')->only('show');
        $this->middleware('permission:Crear Compra Requisicion Proceso Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicion Proceso Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicion Proceso Tipos')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicionProcesoTipo.
     */
    public function index(CompraRequisicionProcesoTipoDataTable $compraRequisicionProcesoTipoDataTable)
    {
    return $compraRequisicionProcesoTipoDataTable->render('compra_requisicion_proceso_tipos.index');
    }


    /**
     * Show the form for creating a new CompraRequisicionProcesoTipo.
     */
    public function create()
    {
        return view('compra_requisicion_proceso_tipos.create');
    }

    /**
     * Store a newly created CompraRequisicionProcesoTipo in storage.
     */
    public function store(CreateCompraRequisicionProcesoTipoRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicionProcesoTipo $compraRequisicionProcesoTipo */
        $compraRequisicionProcesoTipo = CompraRequisicionProcesoTipo::create($input);

        flash()->success('Compra Requisicion Proceso Tipo guardado.');

        return redirect(route('compra.requisiciones.proceso-tipos.index'));
    }

    /**
     * Display the specified CompraRequisicionProcesoTipo.
     */
    public function show($id)
    {
        /** @var CompraRequisicionProcesoTipo $compraRequisicionProcesoTipo */
        $compraRequisicionProcesoTipo = CompraRequisicionProcesoTipo::find($id);

        if (empty($compraRequisicionProcesoTipo)) {
            flash()->error('Compra Requisicion Proceso Tipo no encontrado');

            return redirect(route('compra.requisiciones.proceso-tipos.index'));
        }

        return view('compra_requisicion_proceso_tipos.show')->with('compraRequisicionProcesoTipo', $compraRequisicionProcesoTipo);
    }

    /**
     * Show the form for editing the specified CompraRequisicionProcesoTipo.
     */
    public function edit($id)
    {
        /** @var CompraRequisicionProcesoTipo $compraRequisicionProcesoTipo */
        $compraRequisicionProcesoTipo = CompraRequisicionProcesoTipo::find($id);

        if (empty($compraRequisicionProcesoTipo)) {
            flash()->error('Compra Requisicion Proceso Tipo no encontrado');

            return redirect(route('compra.requisiciones.proceso-tipos.index'));
        }

        return view('compra_requisicion_proceso_tipos.edit')->with('compraRequisicionProcesoTipo', $compraRequisicionProcesoTipo);
    }

    /**
     * Update the specified CompraRequisicionProcesoTipo in storage.
     */
    public function update($id, UpdateCompraRequisicionProcesoTipoRequest $request)
    {
        /** @var CompraRequisicionProcesoTipo $compraRequisicionProcesoTipo */
        $compraRequisicionProcesoTipo = CompraRequisicionProcesoTipo::find($id);

        if (empty($compraRequisicionProcesoTipo)) {
            flash()->error('Compra Requisicion Proceso Tipo no encontrado');

            return redirect(route('compra.requisiciones.proceso-tipos.index'));
        }

        $compraRequisicionProcesoTipo->fill($request->all());
        $compraRequisicionProcesoTipo->save();

        flash()->success('Compra Requisicion Proceso Tipo actualizado.');

        return redirect(route('compra.requisiciones.proceso-tipos.index'));
    }

    /**
     * Remove the specified CompraRequisicionProcesoTipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicionProcesoTipo $compraRequisicionProcesoTipo */
        $compraRequisicionProcesoTipo = CompraRequisicionProcesoTipo::find($id);

        if (empty($compraRequisicionProcesoTipo)) {
            flash()->error('Compra Requisicion Proceso Tipo no encontrado');

            return redirect(route('compra.requisiciones.proceso-tipos.index'));
        }

        $compraRequisicionProcesoTipo->delete();

        flash()->success('Compra Requisicion Proceso Tipo eliminado.');

        return redirect(route('compra.requisiciones.proceso-tipos.index'));
    }
}
