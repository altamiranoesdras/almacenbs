<?php

namespace App\Http\Controllers;

use App\DataTables\RrhhUnidadDataTable;
use App\Http\Requests\CreateRrhhUnidadRequest;
use App\Http\Requests\UpdateRrhhUnidadRequest;
use App\Models\RrhhUnidad;
use Flash;
use Response;

class RrhhUnidadController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Rrhh Unidads')->only(['show']);
        $this->middleware('permission:Crear Rrhh Unidads')->only(['create','store']);
        $this->middleware('permission:Editar Rrhh Unidads')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Rrhh Unidads')->only(['destroy']);
    }

    /**
     * Display a listing of the RrhhUnidad.
     *
     * @param RrhhUnidadDataTable $rrhhUnidadDataTable
     * @return Response
     */
    public function index(RrhhUnidadDataTable $rrhhUnidadDataTable)
    {
        return $rrhhUnidadDataTable->render('rrhh_unidads.index');
    }

    /**
     * Show the form for creating a new RrhhUnidad.
     *
     * @return Response
     */
    public function create(RrhhUnidad $unidad)
    {
        $parent = $unidad ?? null;

        return view('rrhh_unidades.create', compact('parent'));
    }

    /**
     * Store a newly created RrhhUnidad in storage.
     *
     * @param CreateRrhhUnidadRequest $request
     *
     * @return Response
     */
    public function store(CreateRrhhUnidadRequest $request)
    {
        $request->merge([
            'solicita' => $request->has('solicita') ? 'si' : 'no',
            'activa' => $request->has('activa') ? 'si' : 'no',
        ]);

        $input = $request->all();
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::create($input);

        Flash::success('Rrhh Unidad guardado exitosamente.');

        return redirect(route('rrhhUnidades.index'));
    }

    /**
     * Display the specified RrhhUnidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            Flash::error('Rrhh Unidad no encontrado');

            return redirect(route('rrhhUnidads.index'));
        }

        return view('rrhh_unidads.show')->with('rrhhUnidad', $rrhhUnidad);
    }

    /**
     * Show the form for editing the specified RrhhUnidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            Flash::error('Rrhh Unidad no encontrado');

            return redirect(route('rrhhUnidads.index'));
        }

        return view('rrhh_unidads.edit')->with('rrhhUnidad', $rrhhUnidad);
    }

    /**
     * Update the specified RrhhUnidad in storage.
     *
     * @param  int              $id
     * @param UpdateRrhhUnidadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRrhhUnidadRequest $request)
    {
        $request->merge([
            'solicita' => $request->has('solicita') ? 'si' : 'no',
            'activa' => $request->has('activa') ? 'si' : 'no',
        ]);

        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            Flash::error('Rrhh Unidad no encontrado');

            return redirect(route('rrhhUnidades.index'));
        }

        $rrhhUnidad->fill($request->all());
        $rrhhUnidad->save();

        Flash::success('Rrhh Unidad actualizado con éxito.');

        return redirect(route('rrhhUnidades.index'));
    }

    /**
     * Remove the specified RrhhUnidad from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            Flash::error('Rrhh Unidad no encontrado');

            return redirect(route('rrhhUnidads.index'));
        }

        $rrhhUnidad->delete();

        Flash::success('Rrhh Unidad deleted successfully.');

        return redirect(route('rrhhUnidads.index'));
    }
}
