<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionProgramaDataTable;
use App\Http\Requests\CreateRedProduccionProgramaRequest;
use App\Http\Requests\UpdateRedProduccionProgramaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionPrograma;
use Illuminate\Http\Request;

class RedProduccionProgramaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Produccion Programas')->only('show');
        $this->middleware('permission:Crear Red Produccion Programas')->only(['create','store']);
        $this->middleware('permission:Editar Red Produccion Programas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Produccion Programas')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionPrograma.
     */
    public function index(RedProduccionProgramaDataTable $redProduccionProgramaDataTable)
    {
    return $redProduccionProgramaDataTable->render('red_produccion_programas.index');
    }


    /**
     * Show the form for creating a new RedProduccionPrograma.
     */
    public function create()
    {
        return view('red_produccion_programas.create');
    }

    /**
     * Store a newly created RedProduccionPrograma in storage.
     */
    public function store(CreateRedProduccionProgramaRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionPrograma $redProduccionPrograma */
        $redProduccionPrograma = RedProduccionPrograma::create($input);

        flash()->success('Red Produccion Programa guardado.');

        return redirect(route('redProduccionProgramas.index'));
    }

    /**
     * Display the specified RedProduccionPrograma.
     */
    public function show($id)
    {
        /** @var RedProduccionPrograma $redProduccionPrograma */
        $redProduccionPrograma = RedProduccionPrograma::find($id);

        if (empty($redProduccionPrograma)) {
            flash()->error('Red Produccion Programa no encontrado');

            return redirect(route('redProduccionProgramas.index'));
        }

        return view('red_produccion_programas.show')->with('redProduccionPrograma', $redProduccionPrograma);
    }

    /**
     * Show the form for editing the specified RedProduccionPrograma.
     */
    public function edit($id)
    {
        /** @var RedProduccionPrograma $redProduccionPrograma */
        $redProduccionPrograma = RedProduccionPrograma::find($id);

        if (empty($redProduccionPrograma)) {
            flash()->error('Red Produccion Programa no encontrado');

            return redirect(route('redProduccionProgramas.index'));
        }

        return view('red_produccion_programas.edit')->with('redProduccionPrograma', $redProduccionPrograma);
    }

    /**
     * Update the specified RedProduccionPrograma in storage.
     */
    public function update($id, UpdateRedProduccionProgramaRequest $request)
    {
        /** @var RedProduccionPrograma $redProduccionPrograma */
        $redProduccionPrograma = RedProduccionPrograma::find($id);

        if (empty($redProduccionPrograma)) {
            flash()->error('Red Produccion Programa no encontrado');

            return redirect(route('redProduccionProgramas.index'));
        }

        $redProduccionPrograma->fill($request->all());
        $redProduccionPrograma->save();

        flash()->success('Red Produccion Programa actualizado.');

        return redirect(route('redProduccionProgramas.index'));
    }

    /**
     * Remove the specified RedProduccionPrograma from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionPrograma $redProduccionPrograma */
        $redProduccionPrograma = RedProduccionPrograma::find($id);

        if (empty($redProduccionPrograma)) {
            flash()->error('Red Produccion Programa no encontrado');

            return redirect(route('redProduccionProgramas.index'));
        }

        $redProduccionPrograma->delete();

        flash()->success('Red Produccion Programa eliminado.');

        return redirect(route('redProduccionProgramas.index'));
    }
}
