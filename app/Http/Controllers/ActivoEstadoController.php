<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoEstadoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoEstadoRequest;
use App\Http\Requests\UpdateActivoEstadoRequest;
use App\Models\ActivoEstado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Estados')->only(['show']);
        $this->middleware('permission:Crear Activo Estados')->only(['create','store']);
        $this->middleware('permission:Editar Activo Estados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Estados')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoEstado.
     *
     * @param ActivoEstadoDataTable $activoEstadoDataTable
     * @return Response
     */
    public function index(ActivoEstadoDataTable $activoEstadoDataTable)
    {
        return $activoEstadoDataTable->render('activo_estados.index');
    }

    /**
     * Show the form for creating a new ActivoEstado.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_estados.create');
    }

    /**
     * Store a newly created ActivoEstado in storage.
     *
     * @param CreateActivoEstadoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoEstadoRequest $request)
    {
        $input = $request->all();

        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::create($input);

        Flash::success('Activo Estado guardado exitosamente.');

        return redirect(route('activoEstados.index'));
    }

    /**
     * Display the specified ActivoEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            Flash::error('Activo Estado no encontrado');

            return redirect(route('activoEstados.index'));
        }

        return view('activo_estados.show')->with('activoEstado', $activoEstado);
    }

    /**
     * Show the form for editing the specified ActivoEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            Flash::error('Activo Estado no encontrado');

            return redirect(route('activoEstados.index'));
        }

        return view('activo_estados.edit')->with('activoEstado', $activoEstado);
    }

    /**
     * Update the specified ActivoEstado in storage.
     *
     * @param  int              $id
     * @param UpdateActivoEstadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoEstadoRequest $request)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            Flash::error('Activo Estado no encontrado');

            return redirect(route('activoEstados.index'));
        }

        $activoEstado->fill($request->all());
        $activoEstado->save();

        Flash::success('Activo Estado actualizado con éxito.');

        return redirect(route('activoEstados.index'));
    }

    /**
     * Remove the specified ActivoEstado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoEstado $activoEstado */
        $activoEstado = ActivoEstado::find($id);

        if (empty($activoEstado)) {
            Flash::error('Activo Estado no encontrado');

            return redirect(route('activoEstados.index'));
        }

        $activoEstado->delete();

        Flash::success('Activo Estado deleted successfully.');

        return redirect(route('activoEstados.index'));
    }
}
