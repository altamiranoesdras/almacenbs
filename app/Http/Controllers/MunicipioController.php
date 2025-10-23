<?php

namespace App\Http\Controllers;

use App\DataTables\MunicipioDataTable;
use App\Http\Requests\CreateMunicipioRequest;
use App\Http\Requests\UpdateMunicipioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Municipios')->only('show');
        $this->middleware('permission:Crear Municipios')->only(['create','store']);
        $this->middleware('permission:Editar Municipios')->only(['edit','update']);
        $this->middleware('permission:Eliminar Municipios')->only('destroy');
    }
    /**
     * Display a listing of the Municipio.
     */
    public function index(MunicipioDataTable $municipioDataTable)
    {
    return $municipioDataTable->render('municipios.index');
    }


    /**
     * Show the form for creating a new Municipio.
     */
    public function create()
    {
        return view('municipios.create');
    }

    /**
     * Store a newly created Municipio in storage.
     */
    public function store(CreateMunicipioRequest $request)
    {
        $input = $request->all();

        /** @var Municipio $municipio */
        $municipio = Municipio::create($input);

        flash()->success('Municipio guardado.');

        return redirect(route('municipios.index'));
    }

    /**
     * Display the specified Municipio.
     */
    public function show($id)
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            flash()->error('Municipio no encontrado');

            return redirect(route('municipios.index'));
        }

        return view('municipios.show')->with('municipio', $municipio);
    }

    /**
     * Show the form for editing the specified Municipio.
     */
    public function edit($id)
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            flash()->error('Municipio no encontrado');

            return redirect(route('municipios.index'));
        }

        return view('municipios.edit')->with('municipio', $municipio);
    }

    /**
     * Update the specified Municipio in storage.
     */
    public function update($id, UpdateMunicipioRequest $request)
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            flash()->error('Municipio no encontrado');

            return redirect(route('municipios.index'));
        }

        $municipio->fill($request->all());
        $municipio->save();

        flash()->success('Municipio actualizado.');

        return redirect(route('municipios.index'));
    }

    /**
     * Remove the specified Municipio from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Municipio $municipio */
        $municipio = Municipio::find($id);

        if (empty($municipio)) {
            flash()->error('Municipio no encontrado');

            return redirect(route('municipios.index'));
        }

        $municipio->delete();

        flash()->success('Municipio eliminado.');

        return redirect(route('municipios.index'));
    }
}
