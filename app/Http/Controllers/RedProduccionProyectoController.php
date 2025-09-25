<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionProyectoDataTable;
use App\Http\Requests\CreateRedProduccionProyectoRequest;
use App\Http\Requests\UpdateRedProduccionProyectoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionProyecto;
use Illuminate\Http\Request;

class RedProduccionProyectoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Produccion Proyectos')->only('show');
        $this->middleware('permission:Crear Red Produccion Proyectos')->only(['create','store']);
        $this->middleware('permission:Editar Red Produccion Proyectos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Produccion Proyectos')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionProyecto.
     */
    public function index(RedProduccionProyectoDataTable $redProduccionProyectoDataTable)
    {
    return $redProduccionProyectoDataTable->render('red_produccion_proyectos.index');
    }


    /**
     * Show the form for creating a new RedProduccionProyecto.
     */
    public function create()
    {
        return view('red_produccion_proyectos.create');
    }

    /**
     * Store a newly created RedProduccionProyecto in storage.
     */
    public function store(CreateRedProduccionProyectoRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionProyecto $redProduccionProyecto */
        $redProduccionProyecto = RedProduccionProyecto::create($input);

        flash()->success('Red Produccion Proyecto guardado.');

        return redirect(route('redProduccionProyectos.index'));
    }

    /**
     * Display the specified RedProduccionProyecto.
     */
    public function show($id)
    {
        /** @var RedProduccionProyecto $redProduccionProyecto */
        $redProduccionProyecto = RedProduccionProyecto::find($id);

        if (empty($redProduccionProyecto)) {
            flash()->error('Red Produccion Proyecto no encontrado');

            return redirect(route('redProduccionProyectos.index'));
        }

        return view('red_produccion_proyectos.show')->with('redProduccionProyecto', $redProduccionProyecto);
    }

    /**
     * Show the form for editing the specified RedProduccionProyecto.
     */
    public function edit($id)
    {
        /** @var RedProduccionProyecto $redProduccionProyecto */
        $redProduccionProyecto = RedProduccionProyecto::find($id);

        if (empty($redProduccionProyecto)) {
            flash()->error('Red Produccion Proyecto no encontrado');

            return redirect(route('redProduccionProyectos.index'));
        }

        return view('red_produccion_proyectos.edit')->with('redProduccionProyecto', $redProduccionProyecto);
    }

    /**
     * Update the specified RedProduccionProyecto in storage.
     */
    public function update($id, UpdateRedProduccionProyectoRequest $request)
    {
        /** @var RedProduccionProyecto $redProduccionProyecto */
        $redProduccionProyecto = RedProduccionProyecto::find($id);

        if (empty($redProduccionProyecto)) {
            flash()->error('Red Produccion Proyecto no encontrado');

            return redirect(route('redProduccionProyectos.index'));
        }

        $redProduccionProyecto->fill($request->all());
        $redProduccionProyecto->save();

        flash()->success('Red Produccion Proyecto actualizado.');

        return redirect(route('redProduccionProyectos.index'));
    }

    /**
     * Remove the specified RedProduccionProyecto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionProyecto $redProduccionProyecto */
        $redProduccionProyecto = RedProduccionProyecto::find($id);

        if (empty($redProduccionProyecto)) {
            flash()->error('Red Produccion Proyecto no encontrado');

            return redirect(route('redProduccionProyectos.index'));
        }

        $redProduccionProyecto->delete();

        flash()->success('Red Produccion Proyecto eliminado.');

        return redirect(route('redProduccionProyectos.index'));
    }
}
