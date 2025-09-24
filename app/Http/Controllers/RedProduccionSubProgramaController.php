<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionSubProgramaDataTable;
use App\Http\Requests\CreateRedProduccionSubProgramaRequest;
use App\Http\Requests\UpdateRedProduccionSubProgramaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionSubPrograma;
use Illuminate\Http\Request;

class RedProduccionSubProgramaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Produccion Sub Programas')->only('show');
        $this->middleware('permission:Crear Red Produccion Sub Programas')->only(['create','store']);
        $this->middleware('permission:Editar Red Produccion Sub Programas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Produccion Sub Programas')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionSubPrograma.
     */
    public function index(RedProduccionSubProgramaDataTable $redProduccionSubProgramaDataTable)
    {
    return $redProduccionSubProgramaDataTable->render('red_produccion_sub_programas.index');
    }


    /**
     * Show the form for creating a new RedProduccionSubPrograma.
     */
    public function create()
    {
        return view('red_produccion_sub_programas.create');
    }

    /**
     * Store a newly created RedProduccionSubPrograma in storage.
     */
    public function store(CreateRedProduccionSubProgramaRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionSubPrograma $redProduccionSubPrograma */
        $redProduccionSubPrograma = RedProduccionSubPrograma::create($input);

        flash()->success('Red Produccion Sub Programa guardado.');

        return redirect(route('redProduccionSubProgramas.index'));
    }

    /**
     * Display the specified RedProduccionSubPrograma.
     */
    public function show($id)
    {
        /** @var RedProduccionSubPrograma $redProduccionSubPrograma */
        $redProduccionSubPrograma = RedProduccionSubPrograma::find($id);

        if (empty($redProduccionSubPrograma)) {
            flash()->error('Red Produccion Sub Programa no encontrado');

            return redirect(route('redProduccionSubProgramas.index'));
        }

        return view('red_produccion_sub_programas.show')->with('redProduccionSubPrograma', $redProduccionSubPrograma);
    }

    /**
     * Show the form for editing the specified RedProduccionSubPrograma.
     */
    public function edit($id)
    {
        /** @var RedProduccionSubPrograma $redProduccionSubPrograma */
        $redProduccionSubPrograma = RedProduccionSubPrograma::find($id);

        if (empty($redProduccionSubPrograma)) {
            flash()->error('Red Produccion Sub Programa no encontrado');

            return redirect(route('redProduccionSubProgramas.index'));
        }

        return view('red_produccion_sub_programas.edit')->with('redProduccionSubPrograma', $redProduccionSubPrograma);
    }

    /**
     * Update the specified RedProduccionSubPrograma in storage.
     */
    public function update($id, UpdateRedProduccionSubProgramaRequest $request)
    {
        /** @var RedProduccionSubPrograma $redProduccionSubPrograma */
        $redProduccionSubPrograma = RedProduccionSubPrograma::find($id);

        if (empty($redProduccionSubPrograma)) {
            flash()->error('Red Produccion Sub Programa no encontrado');

            return redirect(route('redProduccionSubProgramas.index'));
        }

        $redProduccionSubPrograma->fill($request->all());
        $redProduccionSubPrograma->save();

        flash()->success('Red Produccion Sub Programa actualizado.');

        return redirect(route('redProduccionSubProgramas.index'));
    }

    /**
     * Remove the specified RedProduccionSubPrograma from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionSubPrograma $redProduccionSubPrograma */
        $redProduccionSubPrograma = RedProduccionSubPrograma::find($id);

        if (empty($redProduccionSubPrograma)) {
            flash()->error('Red Produccion Sub Programa no encontrado');

            return redirect(route('redProduccionSubProgramas.index'));
        }

        $redProduccionSubPrograma->delete();

        flash()->success('Red Produccion Sub Programa eliminado.');

        return redirect(route('redProduccionSubProgramas.index'));
    }
}
