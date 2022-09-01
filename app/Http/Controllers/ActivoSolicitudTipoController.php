<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoSolicitudTipoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoSolicitudTipoRequest;
use App\Http\Requests\UpdateActivoSolicitudTipoRequest;
use App\Models\ActivoSolicitudTipo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoSolicitudTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Solicitud Tipos')->only(['show']);
        $this->middleware('permission:Crear Activo Solicitud Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Activo Solicitud Tipos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Solicitud Tipos')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoSolicitudTipo.
     *
     * @param ActivoSolicitudTipoDataTable $activoSolicitudTipoDataTable
     * @return Response
     */
    public function index(ActivoSolicitudTipoDataTable $activoSolicitudTipoDataTable)
    {
        return $activoSolicitudTipoDataTable->render('activo_solicitud_tipos.index');
    }

    /**
     * Show the form for creating a new ActivoSolicitudTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_solicitud_tipos.create');
    }

    /**
     * Store a newly created ActivoSolicitudTipo in storage.
     *
     * @param CreateActivoSolicitudTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudTipoRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::create($input);

        Flash::success('Activo Solicitud Tipo guardado exitosamente.');

        return redirect(route('activoSolicitudTipos.index'));
    }

    /**
     * Display the specified ActivoSolicitudTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            Flash::error('Activo Solicitud Tipo no encontrado');

            return redirect(route('activoSolicitudTipos.index'));
        }

        return view('activo_solicitud_tipos.show')->with('activoSolicitudTipo', $activoSolicitudTipo);
    }

    /**
     * Show the form for editing the specified ActivoSolicitudTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            Flash::error('Activo Solicitud Tipo no encontrado');

            return redirect(route('activoSolicitudTipos.index'));
        }

        return view('activo_solicitud_tipos.edit')->with('activoSolicitudTipo', $activoSolicitudTipo);
    }

    /**
     * Update the specified ActivoSolicitudTipo in storage.
     *
     * @param  int              $id
     * @param UpdateActivoSolicitudTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudTipoRequest $request)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            Flash::error('Activo Solicitud Tipo no encontrado');

            return redirect(route('activoSolicitudTipos.index'));
        }

        $activoSolicitudTipo->fill($request->all());
        $activoSolicitudTipo->save();

        Flash::success('Activo Solicitud Tipo actualizado con éxito.');

        return redirect(route('activoSolicitudTipos.index'));
    }

    /**
     * Remove the specified ActivoSolicitudTipo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitudTipo $activoSolicitudTipo */
        $activoSolicitudTipo = ActivoSolicitudTipo::find($id);

        if (empty($activoSolicitudTipo)) {
            Flash::error('Activo Solicitud Tipo no encontrado');

            return redirect(route('activoSolicitudTipos.index'));
        }

        $activoSolicitudTipo->delete();

        Flash::success('Activo Solicitud Tipo deleted successfully.');

        return redirect(route('activoSolicitudTipos.index'));
    }
}
