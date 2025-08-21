<?php

namespace App\Http\Controllers;

use App\DataTables\CompraRequisicionTipoConcursoDataTable;
use App\Http\Requests\CreateCompraRequisicionTipoConcursoRequest;
use App\Http\Requests\UpdateCompraRequisicionTipoConcursoRequest;
use App\Models\CompraRequisicionTipoConcurso;

class CompraRequisicionTipoConcursoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Requisicion Tipo Concursos')->only('show');
        $this->middleware('permission:Crear Compra Requisicion Tipo Concursos')->only(['create','store']);
        $this->middleware('permission:Editar Compra Requisicion Tipo Concursos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Requisicion Tipo Concursos')->only('destroy');
    }
    /**
     * Display a listing of the CompraRequisicionTipoConcurso.
     */
    public function index(CompraRequisicionTipoConcursoDataTable $compraRequisicionTipoConcursoDataTable)
    {
    return $compraRequisicionTipoConcursoDataTable->render('compra_requisicion_tipo_concursos.index');
    }


    /**
     * Show the form for creating a new CompraRequisicionTipoConcurso.
     */
    public function create()
    {
        return view('compra_requisicion_tipo_concursos.create');
    }

    /**
     * Store a newly created CompraRequisicionTipoConcurso in storage.
     */
    public function store(CreateCompraRequisicionTipoConcursoRequest $request)
    {
        $input = $request->all();

        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::create($input);

        flash()->success('Compra Requisicion Tipo Concurso guardado.');

        return redirect(route('compra.requisiciones.tipo-concursos.index'));
    }

    /**
     * Display the specified CompraRequisicionTipoConcurso.
     */
    public function show($id)
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            flash()->error('Compra Requisicion Tipo Concurso no encontrado');

            return redirect(route('compra.requisiciones.tipo-concursos.index'));
        }

        return view('compra_requisicion_tipo_concursos.show')->with('compraRequisicionTipoConcurso', $compraRequisicionTipoConcurso);
    }

    /**
     * Show the form for editing the specified CompraRequisicionTipoConcurso.
     */
    public function edit($id)
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            flash()->error('Compra Requisicion Tipo Concurso no encontrado');

            return redirect(route('compra.requisiciones.tipo-concursos.index'));
        }

        return view('compra_requisicion_tipo_concursos.edit')->with('compraRequisicionTipoConcurso', $compraRequisicionTipoConcurso);
    }

    /**
     * Update the specified CompraRequisicionTipoConcurso in storage.
     */
    public function update($id, UpdateCompraRequisicionTipoConcursoRequest $request)
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            flash()->error('Compra Requisicion Tipo Concurso no encontrado');

            return redirect(route('compra.requisiciones.tipo-concursos.index'));
        }

        $compraRequisicionTipoConcurso->fill($request->all());
        $compraRequisicionTipoConcurso->save();

        flash()->success('Compra Requisicion Tipo Concurso actualizado.');

        return redirect(route('compra.requisiciones.tipo-concursos.index'));
    }

    /**
     * Remove the specified CompraRequisicionTipoConcurso from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            flash()->error('Compra Requisicion Tipo Concurso no encontrado');

            return redirect(route('compra.requisiciones.tipo-concursos.index'));
        }

        $compraRequisicionTipoConcurso->delete();

        flash()->success('Compra Requisicion Tipo Concurso eliminado.');

        return redirect(route('compra.requisiciones.tipo-concursos.index'));
    }
}
