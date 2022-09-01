<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoTipoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoTipoRequest;
use App\Http\Requests\UpdateActivoTipoRequest;
use App\Models\ActivoTipo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Tipos')->only(['show']);
        $this->middleware('permission:Crear Activo Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Activo Tipos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Tipos')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoTipo.
     *
     * @param ActivoTipoDataTable $activoTipoDataTable
     * @return Response
     */
    public function index(ActivoTipoDataTable $activoTipoDataTable)
    {
        return $activoTipoDataTable->render('activo_tipos.index');
    }

    /**
     * Show the form for creating a new ActivoTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_tipos.create');
    }

    /**
     * Store a newly created ActivoTipo in storage.
     *
     * @param CreateActivoTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTipoRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::create($input);

        Flash::success('Activo Tipo guardado exitosamente.');

        return redirect(route('activoTipos.index'));
    }

    /**
     * Display the specified ActivoTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            Flash::error('Activo Tipo no encontrado');

            return redirect(route('activoTipos.index'));
        }

        return view('activo_tipos.show')->with('activoTipo', $activoTipo);
    }

    /**
     * Show the form for editing the specified ActivoTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            Flash::error('Activo Tipo no encontrado');

            return redirect(route('activoTipos.index'));
        }

        return view('activo_tipos.edit')->with('activoTipo', $activoTipo);
    }

    /**
     * Update the specified ActivoTipo in storage.
     *
     * @param  int              $id
     * @param UpdateActivoTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTipoRequest $request)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            Flash::error('Activo Tipo no encontrado');

            return redirect(route('activoTipos.index'));
        }

        $activoTipo->fill($request->all());
        $activoTipo->save();

        Flash::success('Activo Tipo actualizado con éxito.');

        return redirect(route('activoTipos.index'));
    }

    /**
     * Remove the specified ActivoTipo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTipo $activoTipo */
        $activoTipo = ActivoTipo::find($id);

        if (empty($activoTipo)) {
            Flash::error('Activo Tipo no encontrado');

            return redirect(route('activoTipos.index'));
        }

        $activoTipo->delete();

        Flash::success('Activo Tipo deleted successfully.');

        return redirect(route('activoTipos.index'));
    }
}
