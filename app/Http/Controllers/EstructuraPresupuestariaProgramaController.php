<?php

namespace App\Http\Controllers;

use App\DataTables\EstructuraPresupuestariaProgramaDataTable;
use App\Http\Requests\CreateEstructuraPresupuestariaProgramaRequest;
use App\Http\Requests\UpdateEstructuraPresupuestariaProgramaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\EstructuraPresupuestariaPrograma;
use Illuminate\Http\Request;

class EstructuraPresupuestariaProgramaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Estructura Presupuestaria Programas')->only('show');
        $this->middleware('permission:Crear Estructura Presupuestaria Programas')->only(['create','store']);
        $this->middleware('permission:Editar Estructura Presupuestaria Programas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Estructura Presupuestaria Programas')->only('destroy');
    }
    /**
     * Display a listing of the EstructuraPresupuestariaPrograma.
     */
    public function index(EstructuraPresupuestariaProgramaDataTable $estructuraPresupuestariaProgramaDataTable)
    {
    return $estructuraPresupuestariaProgramaDataTable->render('estructura_presupuestaria_programas.index');
    }


    /**
     * Show the form for creating a new EstructuraPresupuestariaPrograma.
     */
    public function create()
    {
        return view('estructura_presupuestaria_programas.create');
    }

    /**
     * Store a newly created EstructuraPresupuestariaPrograma in storage.
     */
    public function store(CreateEstructuraPresupuestariaProgramaRequest $request)
    {
        $input = $request->all();

        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::create($input);

        flash()->success('Estructura Presupuestaria Programa guardado.');

        return redirect(route('estructuraPresupuestariaProgramas.index'));
    }

    /**
     * Display the specified EstructuraPresupuestariaPrograma.
     */
    public function show($id)
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            flash()->error('Estructura Presupuestaria Programa no encontrado');

            return redirect(route('estructuraPresupuestariaProgramas.index'));
        }

        return view('estructura_presupuestaria_programas.show')->with('estructuraPresupuestariaPrograma', $estructuraPresupuestariaPrograma);
    }

    /**
     * Show the form for editing the specified EstructuraPresupuestariaPrograma.
     */
    public function edit($id)
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            flash()->error('Estructura Presupuestaria Programa no encontrado');

            return redirect(route('estructuraPresupuestariaProgramas.index'));
        }

        return view('estructura_presupuestaria_programas.edit')->with('estructuraPresupuestariaPrograma', $estructuraPresupuestariaPrograma);
    }

    /**
     * Update the specified EstructuraPresupuestariaPrograma in storage.
     */
    public function update($id, UpdateEstructuraPresupuestariaProgramaRequest $request)
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            flash()->error('Estructura Presupuestaria Programa no encontrado');

            return redirect(route('estructuraPresupuestariaProgramas.index'));
        }

        $estructuraPresupuestariaPrograma->fill($request->all());
        $estructuraPresupuestariaPrograma->save();

        flash()->success('Estructura Presupuestaria Programa actualizado.');

        return redirect(route('estructuraPresupuestariaProgramas.index'));
    }

    /**
     * Remove the specified EstructuraPresupuestariaPrograma from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var EstructuraPresupuestariaPrograma $estructuraPresupuestariaPrograma */
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::find($id);

        if (empty($estructuraPresupuestariaPrograma)) {
            flash()->error('Estructura Presupuestaria Programa no encontrado');

            return redirect(route('estructuraPresupuestariaProgramas.index'));
        }

        $estructuraPresupuestariaPrograma->delete();

        flash()->success('Estructura Presupuestaria Programa eliminado.');

        return redirect(route('estructuraPresupuestariaProgramas.index'));
    }
}
