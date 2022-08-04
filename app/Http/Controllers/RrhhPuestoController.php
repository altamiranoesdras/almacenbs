<?php

namespace App\Http\Controllers;

use App\DataTables\RrhhPuestoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRrhhPuestoRequest;
use App\Http\Requests\UpdateRrhhPuestoRequest;
use App\Models\RrhhPuesto;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RrhhPuestoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Rrhh Puestos')->only(['show']);
        $this->middleware('permission:Crear Rrhh Puestos')->only(['create','store']);
        $this->middleware('permission:Editar Rrhh Puestos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Rrhh Puestos')->only(['destroy']);
    }

    /**
     * Display a listing of the RrhhPuesto.
     *
     * @param RrhhPuestoDataTable $rrhhPuestoDataTable
     * @return Response
     */
    public function index(RrhhPuestoDataTable $rrhhPuestoDataTable)
    {
        return $rrhhPuestoDataTable->render('rrhh_puestos.index');
    }

    /**
     * Show the form for creating a new RrhhPuesto.
     *
     * @return Response
     */
    public function create()
    {
        return view('rrhh_puestos.create');
    }

    /**
     * Store a newly created RrhhPuesto in storage.
     *
     * @param CreateRrhhPuestoRequest $request
     *
     * @return Response
     */
    public function store(CreateRrhhPuestoRequest $request)
    {
        $input = $request->all();

        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::create($input);

        Flash::success('Rrhh Puesto guardado exitosamente.');

        return redirect(route('rrhhPuestos.index'));
    }

    /**
     * Display the specified RrhhPuesto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            Flash::error('Rrhh Puesto no encontrado');

            return redirect(route('rrhhPuestos.index'));
        }

        return view('rrhh_puestos.show')->with('rrhhPuesto', $rrhhPuesto);
    }

    /**
     * Show the form for editing the specified RrhhPuesto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            Flash::error('Rrhh Puesto no encontrado');

            return redirect(route('rrhhPuestos.index'));
        }

        return view('rrhh_puestos.edit')->with('rrhhPuesto', $rrhhPuesto);
    }

    /**
     * Update the specified RrhhPuesto in storage.
     *
     * @param  int              $id
     * @param UpdateRrhhPuestoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRrhhPuestoRequest $request)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            Flash::error('Rrhh Puesto no encontrado');

            return redirect(route('rrhhPuestos.index'));
        }

        $rrhhPuesto->fill($request->all());
        $rrhhPuesto->save();

        Flash::success('Rrhh Puesto actualizado con éxito.');

        return redirect(route('rrhhPuestos.index'));
    }

    /**
     * Remove the specified RrhhPuesto from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhPuesto $rrhhPuesto */
        $rrhhPuesto = RrhhPuesto::find($id);

        if (empty($rrhhPuesto)) {
            Flash::error('Rrhh Puesto no encontrado');

            return redirect(route('rrhhPuestos.index'));
        }

        $rrhhPuesto->delete();

        Flash::success('Rrhh Puesto deleted successfully.');

        return redirect(route('rrhhPuestos.index'));
    }
}
