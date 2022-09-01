<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoSolicitudEstadoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoSolicitudEstadoRequest;
use App\Http\Requests\UpdateActivoSolicitudEstadoRequest;
use App\Models\ActivoSolicitudEstado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoSolicitudEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Solicitud Estados')->only(['show']);
        $this->middleware('permission:Crear Activo Solicitud Estados')->only(['create','store']);
        $this->middleware('permission:Editar Activo Solicitud Estados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Solicitud Estados')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoSolicitudEstado.
     *
     * @param ActivoSolicitudEstadoDataTable $activoSolicitudEstadoDataTable
     * @return Response
     */
    public function index(ActivoSolicitudEstadoDataTable $activoSolicitudEstadoDataTable)
    {
        return $activoSolicitudEstadoDataTable->render('activo_solicitud_estados.index');
    }

    /**
     * Show the form for creating a new ActivoSolicitudEstado.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_solicitud_estados.create');
    }

    /**
     * Store a newly created ActivoSolicitudEstado in storage.
     *
     * @param CreateActivoSolicitudEstadoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudEstadoRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::create($input);

        Flash::success('Activo Solicitud Estado guardado exitosamente.');

        return redirect(route('activoSolicitudEstados.index'));
    }

    /**
     * Display the specified ActivoSolicitudEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            Flash::error('Activo Solicitud Estado no encontrado');

            return redirect(route('activoSolicitudEstados.index'));
        }

        return view('activo_solicitud_estados.show')->with('activoSolicitudEstado', $activoSolicitudEstado);
    }

    /**
     * Show the form for editing the specified ActivoSolicitudEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            Flash::error('Activo Solicitud Estado no encontrado');

            return redirect(route('activoSolicitudEstados.index'));
        }

        return view('activo_solicitud_estados.edit')->with('activoSolicitudEstado', $activoSolicitudEstado);
    }

    /**
     * Update the specified ActivoSolicitudEstado in storage.
     *
     * @param  int              $id
     * @param UpdateActivoSolicitudEstadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudEstadoRequest $request)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            Flash::error('Activo Solicitud Estado no encontrado');

            return redirect(route('activoSolicitudEstados.index'));
        }

        $activoSolicitudEstado->fill($request->all());
        $activoSolicitudEstado->save();

        Flash::success('Activo Solicitud Estado actualizado con éxito.');

        return redirect(route('activoSolicitudEstados.index'));
    }

    /**
     * Remove the specified ActivoSolicitudEstado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitudEstado $activoSolicitudEstado */
        $activoSolicitudEstado = ActivoSolicitudEstado::find($id);

        if (empty($activoSolicitudEstado)) {
            Flash::error('Activo Solicitud Estado no encontrado');

            return redirect(route('activoSolicitudEstados.index'));
        }

        $activoSolicitudEstado->delete();

        Flash::success('Activo Solicitud Estado deleted successfully.');

        return redirect(route('activoSolicitudEstados.index'));
    }
}
