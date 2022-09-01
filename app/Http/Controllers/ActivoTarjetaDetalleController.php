<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoTarjetaDetalleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoTarjetaDetalleRequest;
use App\Http\Requests\UpdateActivoTarjetaDetalleRequest;
use App\Models\ActivoTarjetaDetalle;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoTarjetaDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Tarjeta Detalles')->only(['show']);
        $this->middleware('permission:Crear Activo Tarjeta Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Activo Tarjeta Detalles')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Tarjeta Detalles')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoTarjetaDetalle.
     *
     * @param ActivoTarjetaDetalleDataTable $activoTarjetaDetalleDataTable
     * @return Response
     */
    public function index(ActivoTarjetaDetalleDataTable $activoTarjetaDetalleDataTable)
    {
        return $activoTarjetaDetalleDataTable->render('activo_tarjeta_detalles.index');
    }

    /**
     * Show the form for creating a new ActivoTarjetaDetalle.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_tarjeta_detalles.create');
    }

    /**
     * Store a newly created ActivoTarjetaDetalle in storage.
     *
     * @param CreateActivoTarjetaDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaDetalleRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::create($input);

        Flash::success('Activo Tarjeta Detalle guardado exitosamente.');

        return redirect(route('activoTarjetaDetalles.index'));
    }

    /**
     * Display the specified ActivoTarjetaDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            Flash::error('Activo Tarjeta Detalle no encontrado');

            return redirect(route('activoTarjetaDetalles.index'));
        }

        return view('activo_tarjeta_detalles.show')->with('activoTarjetaDetalle', $activoTarjetaDetalle);
    }

    /**
     * Show the form for editing the specified ActivoTarjetaDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            Flash::error('Activo Tarjeta Detalle no encontrado');

            return redirect(route('activoTarjetaDetalles.index'));
        }

        return view('activo_tarjeta_detalles.edit')->with('activoTarjetaDetalle', $activoTarjetaDetalle);
    }

    /**
     * Update the specified ActivoTarjetaDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateActivoTarjetaDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaDetalleRequest $request)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            Flash::error('Activo Tarjeta Detalle no encontrado');

            return redirect(route('activoTarjetaDetalles.index'));
        }

        $activoTarjetaDetalle->fill($request->all());
        $activoTarjetaDetalle->save();

        Flash::success('Activo Tarjeta Detalle actualizado con éxito.');

        return redirect(route('activoTarjetaDetalles.index'));
    }

    /**
     * Remove the specified ActivoTarjetaDetalle from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjetaDetalle $activoTarjetaDetalle */
        $activoTarjetaDetalle = ActivoTarjetaDetalle::find($id);

        if (empty($activoTarjetaDetalle)) {
            Flash::error('Activo Tarjeta Detalle no encontrado');

            return redirect(route('activoTarjetaDetalles.index'));
        }

        $activoTarjetaDetalle->delete();

        Flash::success('Activo Tarjeta Detalle deleted successfully.');

        return redirect(route('activoTarjetaDetalles.index'));
    }
}
