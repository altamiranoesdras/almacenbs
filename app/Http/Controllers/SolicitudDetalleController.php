<?php

namespace App\Http\Controllers;

use App\DataTables\SolicitudDetalleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSolicitudDetalleRequest;
use App\Http\Requests\UpdateSolicitudDetalleRequest;
use App\Models\SolicitudDetalle;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SolicitudDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Solicitud Detalles')->only(['show']);
        $this->middleware('permission:Crear Solicitud Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Solicitud Detalles')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Solicitud Detalles')->only(['destroy']);
    }

    /**
     * Display a listing of the SolicitudDetalle.
     *
     * @param SolicitudDetalleDataTable $solicitudDetalleDataTable
     * @return Response
     */
    public function index(SolicitudDetalleDataTable $solicitudDetalleDataTable)
    {
        return $solicitudDetalleDataTable->render('solicitud_detalles.index');
    }

    /**
     * Show the form for creating a new SolicitudDetalle.
     *
     * @return Response
     */
    public function create()
    {
        return view('solicitud_detalles.create');
    }

    /**
     * Store a newly created SolicitudDetalle in storage.
     *
     * @param CreateSolicitudDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateSolicitudDetalleRequest $request)
    {
        $input = $request->all();

        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::create($input);

        Flash::success('Solicitud Detalle guardado exitosamente.');

        return redirect(route('solicitudDetalles.index'));
    }

    /**
     * Display the specified SolicitudDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            Flash::error('Solicitud Detalle no encontrado');

            return redirect(route('solicitudDetalles.index'));
        }

        return view('solicitud_detalles.show')->with('solicitudDetalle', $solicitudDetalle);
    }

    /**
     * Show the form for editing the specified SolicitudDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            Flash::error('Solicitud Detalle no encontrado');

            return redirect(route('solicitudDetalles.index'));
        }

        return view('solicitud_detalles.edit')->with('solicitudDetalle', $solicitudDetalle);
    }

    /**
     * Update the specified SolicitudDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateSolicitudDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSolicitudDetalleRequest $request)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            Flash::error('Solicitud Detalle no encontrado');

            return redirect(route('solicitudDetalles.index'));
        }

        $solicitudDetalle->fill($request->all());
        $solicitudDetalle->save();

        Flash::success('Solicitud Detalle actualizado con éxito.');

        return redirect(route('solicitudDetalles.index'));
    }

    /**
     * Remove the specified SolicitudDetalle from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SolicitudDetalle $solicitudDetalle */
        $solicitudDetalle = SolicitudDetalle::find($id);

        if (empty($solicitudDetalle)) {
            Flash::error('Solicitud Detalle no encontrado');

            return redirect(route('solicitudDetalles.index'));
        }

        $solicitudDetalle->delete();

        Flash::success('Solicitud Detalle deleted successfully.');

        return redirect(route('solicitudDetalles.index'));
    }
}
