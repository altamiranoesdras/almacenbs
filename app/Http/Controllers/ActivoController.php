<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use App\Models\Activo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activos')->only(['show']);
        $this->middleware('permission:Crear Activos')->only(['create','store']);
        $this->middleware('permission:Editar Activos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activos')->only(['destroy']);
    }

    /**
     * Display a listing of the Activo.
     *
     * @param ActivoDataTable $activoDataTable
     * @return Response
     */
    public function index(ActivoDataTable $activoDataTable)
    {
        return $activoDataTable->render('activos.index');
    }

    /**
     * Show the form for creating a new Activo.
     *
     * @return Response
     */
    public function create()
    {
        return view('activos.create');
    }

    /**
     * Store a newly created Activo in storage.
     *
     * @param CreateActivoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoRequest $request)
    {
        $input = $request->all();

        /** @var Activo $activo */
        $activo = Activo::create($input);

        Flash::success('Activo guardado exitosamente.');

        return redirect(route('activos.index'));
    }

    /**
     * Display the specified Activo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        return view('activos.show')->with('activo', $activo);
    }

    /**
     * Show the form for editing the specified Activo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        return view('activos.edit')->with('activo', $activo);
    }

    /**
     * Update the specified Activo in storage.
     *
     * @param  int              $id
     * @param UpdateActivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoRequest $request)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        $activo->fill($request->all());
        $activo->save();

        Flash::success('Activo actualizado con éxito.');

        return redirect(route('activos.index'));
    }

    /**
     * Remove the specified Activo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        $activo->delete();

        Flash::success('Activo deleted successfully.');

        return redirect(route('activos.index'));
    }
}
