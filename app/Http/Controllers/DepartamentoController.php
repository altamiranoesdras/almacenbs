<?php

namespace App\Http\Controllers;

use App\DataTables\DepartamentoDataTable;
use App\Http\Requests\CreateDepartamentoRequest;
use App\Http\Requests\UpdateDepartamentoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Departamentos')->only('show');
        $this->middleware('permission:Crear Departamentos')->only(['create','store']);
        $this->middleware('permission:Editar Departamentos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Departamentos')->only('destroy');
    }
    /**
     * Display a listing of the Departamento.
     */
    public function index(DepartamentoDataTable $departamentoDataTable)
    {
    return $departamentoDataTable->render('departamentos.index');
    }


    /**
     * Show the form for creating a new Departamento.
     */
    public function create()
    {
        return view('departamentos.create');
    }

    /**
     * Store a newly created Departamento in storage.
     */
    public function store(CreateDepartamentoRequest $request)
    {
        $input = $request->all();

        /** @var Departamento $departamento */
        $departamento = Departamento::create($input);

        flash()->success('Departamento guardado.');

        return redirect(route('departamentos.index'));
    }

    /**
     * Display the specified Departamento.
     */
    public function show($id)
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            flash()->error('Departamento no encontrado');

            return redirect(route('departamentos.index'));
        }

        return view('departamentos.show')->with('departamento', $departamento);
    }

    /**
     * Show the form for editing the specified Departamento.
     */
    public function edit($id)
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            flash()->error('Departamento no encontrado');

            return redirect(route('departamentos.index'));
        }

        return view('departamentos.edit')->with('departamento', $departamento);
    }

    /**
     * Update the specified Departamento in storage.
     */
    public function update($id, UpdateDepartamentoRequest $request)
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            flash()->error('Departamento no encontrado');

            return redirect(route('departamentos.index'));
        }

        $departamento->fill($request->all());
        $departamento->save();

        flash()->success('Departamento actualizado.');

        return redirect(route('departamentos.index'));
    }

    /**
     * Remove the specified Departamento from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            flash()->error('Departamento no encontrado');

            return redirect(route('departamentos.index'));
        }

        $departamento->delete();

        flash()->success('Departamento eliminado.');

        return redirect(route('departamentos.index'));
    }
}
