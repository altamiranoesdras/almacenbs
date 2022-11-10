<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoTarjetaEstadoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoTarjetaEstadoRequest;
use App\Http\Requests\UpdateActivoTarjetaEstadoRequest;
use App\Models\ActivoTarjetaEstado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoTarjetaEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Tarjeta Estados')->only(['show']);
        $this->middleware('permission:Crear Activo Tarjeta Estados')->only(['create','store']);
        $this->middleware('permission:Editar Activo Tarjeta Estados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Tarjeta Estados')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoTarjetaEstado.
     *
     * @param ActivoTarjetaEstadoDataTable $activoTarjetaEstadoDataTable
     * @return Response
     */
    public function index(ActivoTarjetaEstadoDataTable $activoTarjetaEstadoDataTable)
    {
        return $activoTarjetaEstadoDataTable->render('activo_tarjeta_estados.index');
    }

    /**
     * Show the form for creating a new ActivoTarjetaEstado.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_tarjeta_estados.create');
    }

    /**
     * Store a newly created ActivoTarjetaEstado in storage.
     *
     * @param CreateActivoTarjetaEstadoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaEstadoRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::create($input);

        Flash::success('Activo Tarjeta Estado guardado exitosamente.');

        return redirect(route('activoTarjetaEstados.index'));
    }

    /**
     * Display the specified ActivoTarjetaEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            Flash::error('Activo Tarjeta Estado no encontrado');

            return redirect(route('activoTarjetaEstados.index'));
        }

        return view('activo_tarjeta_estados.show')->with('activoTarjetaEstado', $activoTarjetaEstado);
    }

    /**
     * Show the form for editing the specified ActivoTarjetaEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            Flash::error('Activo Tarjeta Estado no encontrado');

            return redirect(route('activoTarjetaEstados.index'));
        }

        return view('activo_tarjeta_estados.edit')->with('activoTarjetaEstado', $activoTarjetaEstado);
    }

    /**
     * Update the specified ActivoTarjetaEstado in storage.
     *
     * @param  int              $id
     * @param UpdateActivoTarjetaEstadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaEstadoRequest $request)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            Flash::error('Activo Tarjeta Estado no encontrado');

            return redirect(route('activoTarjetaEstados.index'));
        }

        $activoTarjetaEstado->fill($request->all());
        $activoTarjetaEstado->save();

        Flash::success('Activo Tarjeta Estado actualizado con éxito.');

        return redirect(route('activoTarjetaEstados.index'));
    }

    /**
     * Remove the specified ActivoTarjetaEstado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjetaEstado $activoTarjetaEstado */
        $activoTarjetaEstado = ActivoTarjetaEstado::find($id);

        if (empty($activoTarjetaEstado)) {
            Flash::error('Activo Tarjeta Estado no encontrado');

            return redirect(route('activoTarjetaEstados.index'));
        }

        $activoTarjetaEstado->delete();

        Flash::success('Activo Tarjeta Estado deleted successfully.');

        return redirect(route('activoTarjetaEstados.index'));
    }
}
