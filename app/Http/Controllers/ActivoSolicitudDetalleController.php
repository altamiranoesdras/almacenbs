<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoSolicitudDetalleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoSolicitudDetalleRequest;
use App\Http\Requests\UpdateActivoSolicitudDetalleRequest;
use App\Models\ActivoSolicitudDetalle;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoSolicitudDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Solicitud Detalles')->only(['show']);
        $this->middleware('permission:Crear Activo Solicitud Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Activo Solicitud Detalles')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Solicitud Detalles')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoSolicitudDetalle.
     *
     * @param ActivoSolicitudDetalleDataTable $activoSolicitudDetalleDataTable
     * @return Response
     */
    public function index(ActivoSolicitudDetalleDataTable $activoSolicitudDetalleDataTable)
    {
        return $activoSolicitudDetalleDataTable->render('activo_solicitud_detalles.index');
    }

    /**
     * Show the form for creating a new ActivoSolicitudDetalle.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_solicitud_detalles.create');
    }

    /**
     * Store a newly created ActivoSolicitudDetalle in storage.
     *
     * @param CreateActivoSolicitudDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudDetalleRequest $request)
    {
        $input = $request->all();

        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::create($input);

        Flash::success('Activo Solicitud Detalle guardado exitosamente.');

        return redirect(route('activoSolicitudDetalles.index'));
    }

    /**
     * Display the specified ActivoSolicitudDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            Flash::error('Activo Solicitud Detalle no encontrado');

            return redirect(route('activoSolicitudDetalles.index'));
        }

        return view('activo_solicitud_detalles.show')->with('activoSolicitudDetalle', $activoSolicitudDetalle);
    }

    /**
     * Show the form for editing the specified ActivoSolicitudDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            Flash::error('Activo Solicitud Detalle no encontrado');

            return redirect(route('activoSolicitudDetalles.index'));
        }

        return view('activo_solicitud_detalles.edit')->with('activoSolicitudDetalle', $activoSolicitudDetalle);
    }

    /**
     * Update the specified ActivoSolicitudDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateActivoSolicitudDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudDetalleRequest $request)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            Flash::error('Activo Solicitud Detalle no encontrado');

            return redirect(route('activoSolicitudDetalles.index'));
        }

        $activoSolicitudDetalle->fill($request->all());
        $activoSolicitudDetalle->save();

        Flash::success('Activo Solicitud Detalle actualizado con éxito.');

        return redirect(route('activoSolicitudDetalles.index'));
    }

    /**
     * Remove the specified ActivoSolicitudDetalle from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitudDetalle $activoSolicitudDetalle */
        $activoSolicitudDetalle = ActivoSolicitudDetalle::find($id);

        if (empty($activoSolicitudDetalle)) {
            Flash::error('Activo Solicitud Detalle no encontrado');

            return redirect(route('activoSolicitudDetalles.index'));
        }

        $activoSolicitudDetalle->delete();

        Flash::success('Activo Solicitud Detalle deleted successfully.');

        return redirect(route('activoSolicitudDetalles.index'));
    }
}
