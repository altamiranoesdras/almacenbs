<?php

namespace App\Http\Controllers;

use App\DataTables\DenominacionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDenominacionRequest;
use App\Http\Requests\UpdateDenominacionRequest;
use App\Models\Denominacion;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DenominacionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Denominacions')->only(['show']);
        $this->middleware('permission:Crear Denominacions')->only(['create','store']);
        $this->middleware('permission:Editar Denominacions')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Denominacions')->only(['destroy']);
    }

    /**
     * Display a listing of the Denominacion.
     *
     * @param DenominacionDataTable $denominacionDataTable
     * @return Response
     */
    public function index(DenominacionDataTable $denominacionDataTable)
    {
        return $denominacionDataTable->render('denominacions.index');
    }

    /**
     * Show the form for creating a new Denominacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('denominacions.create');
    }

    /**
     * Store a newly created Denominacion in storage.
     *
     * @param CreateDenominacionRequest $request
     *
     * @return Response
     */
    public function store(CreateDenominacionRequest $request)
    {
        $input = $request->all();

        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::create($input);

        Flash::success('Denominacion guardado exitosamente.');

        return redirect(route('denominacions.index'));
    }

    /**
     * Display the specified Denominacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            Flash::error('Denominacion no encontrado');

            return redirect(route('denominacions.index'));
        }

        return view('denominacions.show')->with('denominacion', $denominacion);
    }

    /**
     * Show the form for editing the specified Denominacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            Flash::error('Denominacion no encontrado');

            return redirect(route('denominacions.index'));
        }

        return view('denominacions.edit')->with('denominacion', $denominacion);
    }

    /**
     * Update the specified Denominacion in storage.
     *
     * @param  int              $id
     * @param UpdateDenominacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDenominacionRequest $request)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            Flash::error('Denominacion no encontrado');

            return redirect(route('denominacions.index'));
        }

        $denominacion->fill($request->all());
        $denominacion->save();

        Flash::success('Denominacion actualizado con éxito.');

        return redirect(route('denominacions.index'));
    }

    /**
     * Remove the specified Denominacion from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            Flash::error('Denominacion no encontrado');

            return redirect(route('denominacions.index'));
        }

        $denominacion->delete();

        Flash::success('Denominacion deleted successfully.');

        return redirect(route('denominacions.index'));
    }
}
