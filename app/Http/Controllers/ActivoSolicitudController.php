<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoSolicitudDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoSolicitudRequest;
use App\Http\Requests\UpdateActivoSolicitudRequest;
use App\Models\ActivoSolicitud;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoSolicitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Solicitudes')->only(['show']);
        $this->middleware('permission:Crear Activo Solicitudes')->only(['create','store']);
        $this->middleware('permission:Editar Activo Solicitudes')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Solicitudes')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoSolicitud.
     *
     * @param ActivoSolicitudDataTable $activoSolicitudDataTable
     * @return Response
     */
    public function index(ActivoSolicitudDataTable $activoSolicitudDataTable)
    {
        return $activoSolicitudDataTable->render('activo_solicituds.index');
    }

    /**
     * Show the form for creating a new ActivoSolicitud.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_solicituds.create');
    }

    /**
     * Store a newly created ActivoSolicitud in storage.
     *
     * @param CreateActivoSolicitudRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::create($input);

        Flash::success('Activo Solicitud guardado exitosamente.');

        return redirect(route('activoSolicitudes.index'));
    }

    /**
     * Display the specified ActivoSolicitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        return view('activo_solicituds.show')->with('activoSolicitud', $activoSolicitud);
    }

    /**
     * Show the form for editing the specified ActivoSolicitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        return view('activo_solicituds.edit')->with('activoSolicitud', $activoSolicitud);
    }

    /**
     * Update the specified ActivoSolicitud in storage.
     *
     * @param  int              $id
     * @param UpdateActivoSolicitudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudRequest $request)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        $activoSolicitud->fill($request->all());
        $activoSolicitud->save();

        Flash::success('Activo Solicitud actualizado con éxito.');

        return redirect(route('activoSolicitudes.index'));
    }

    /**
     * Remove the specified ActivoSolicitud from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        $activoSolicitud->delete();

        Flash::success('Activo Solicitud deleted successfully.');

        return redirect(route('activoSolicitudes.index'));
    }
}
