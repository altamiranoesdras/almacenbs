<?php

namespace App\Http\Controllers;

use App\DataTables\RrhhUnidadTipoDataTable;
use App\Http\Requests\CreateRrhhUnidadTipoRequest;
use App\Http\Requests\UpdateRrhhUnidadTipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RrhhUnidadTipo;
use Illuminate\Http\Request;

class RrhhUnidadTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Rrhh Unidad Tipos')->only('show');
        $this->middleware('permission:Crear Rrhh Unidad Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Rrhh Unidad Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Rrhh Unidad Tipos')->only('destroy');
    }
    /**
     * Display a listing of the RrhhUnidadTipo.
     */
    public function index(RrhhUnidadTipoDataTable $rrhhUnidadTipoDataTable)
    {
    return $rrhhUnidadTipoDataTable->render('rrhh_unidad_tipos.index');
    }


    /**
     * Show the form for creating a new RrhhUnidadTipo.
     */
    public function create()
    {
        return view('rrhh_unidad_tipos.create');
    }

    /**
     * Store a newly created RrhhUnidadTipo in storage.
     */
    public function store(CreateRrhhUnidadTipoRequest $request)
    {
        $input = $request->all();

        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::create($input);

        flash()->success('Rrhh Unidad Tipo guardado.');

        return redirect(route('rrhhUnidadTipos.index'));
    }

    /**
     * Display the specified RrhhUnidadTipo.
     */
    public function show($id)
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            flash()->error('Rrhh Unidad Tipo no encontrado');

            return redirect(route('rrhhUnidadTipos.index'));
        }

        return view('rrhh_unidad_tipos.show')->with('rrhhUnidadTipo', $rrhhUnidadTipo);
    }

    /**
     * Show the form for editing the specified RrhhUnidadTipo.
     */
    public function edit($id)
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            flash()->error('Rrhh Unidad Tipo no encontrado');

            return redirect(route('rrhhUnidadTipos.index'));
        }

        return view('rrhh_unidad_tipos.edit')->with('rrhhUnidadTipo', $rrhhUnidadTipo);
    }

    /**
     * Update the specified RrhhUnidadTipo in storage.
     */
    public function update($id, UpdateRrhhUnidadTipoRequest $request)
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            flash()->error('Rrhh Unidad Tipo no encontrado');

            return redirect(route('rrhhUnidadTipos.index'));
        }

        $rrhhUnidadTipo->fill($request->all());
        $rrhhUnidadTipo->save();

        flash()->success('Rrhh Unidad Tipo actualizado.');

        return redirect(route('rrhhUnidadTipos.index'));
    }

    /**
     * Remove the specified RrhhUnidadTipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RrhhUnidadTipo $rrhhUnidadTipo */
        $rrhhUnidadTipo = RrhhUnidadTipo::find($id);

        if (empty($rrhhUnidadTipo)) {
            flash()->error('Rrhh Unidad Tipo no encontrado');

            return redirect(route('rrhhUnidadTipos.index'));
        }

        $rrhhUnidadTipo->delete();

        flash()->success('Rrhh Unidad Tipo eliminado.');

        return redirect(route('rrhhUnidadTipos.index'));
    }
}
