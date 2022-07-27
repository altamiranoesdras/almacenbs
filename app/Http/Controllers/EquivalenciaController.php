<?php

namespace App\Http\Controllers;

use App\DataTables\EquivalenciaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEquivalenciaRequest;
use App\Http\Requests\UpdateEquivalenciaRequest;
use App\Models\Equivalencia;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EquivalenciaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Equivalencias')->only(['show']);
        $this->middleware('permission:Crear Equivalencias')->only(['create','store']);
        $this->middleware('permission:Editar Equivalencias')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Equivalencias')->only(['destroy']);
    }

    /**
     * Display a listing of the Equivalencia.
     *
     * @param EquivalenciaDataTable $equivalenciaDataTable
     * @return Response
     */
    public function index(EquivalenciaDataTable $equivalenciaDataTable)
    {
        return $equivalenciaDataTable->render('equivalencias.index');
    }

    /**
     * Show the form for creating a new Equivalencia.
     *
     * @return Response
     */
    public function create()
    {
        return view('equivalencias.create');
    }

    /**
     * Store a newly created Equivalencia in storage.
     *
     * @param CreateEquivalenciaRequest $request
     *
     * @return Response
     */
    public function store(CreateEquivalenciaRequest $request)
    {
        $input = $request->all();

        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::create($input);

        Flash::success('Equivalencia guardado exitosamente.');

        return redirect(route('equivalencias.index'));
    }

    /**
     * Display the specified Equivalencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            Flash::error('Equivalencia no encontrado');

            return redirect(route('equivalencias.index'));
        }

        return view('equivalencias.show')->with('equivalencia', $equivalencia);
    }

    /**
     * Show the form for editing the specified Equivalencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            Flash::error('Equivalencia no encontrado');

            return redirect(route('equivalencias.index'));
        }

        return view('equivalencias.edit')->with('equivalencia', $equivalencia);
    }

    /**
     * Update the specified Equivalencia in storage.
     *
     * @param  int              $id
     * @param UpdateEquivalenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquivalenciaRequest $request)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            Flash::error('Equivalencia no encontrado');

            return redirect(route('equivalencias.index'));
        }

        $equivalencia->fill($request->all());
        $equivalencia->save();

        Flash::success('Equivalencia actualizado con éxito.');

        return redirect(route('equivalencias.index'));
    }

    /**
     * Remove the specified Equivalencia from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            Flash::error('Equivalencia no encontrado');

            return redirect(route('equivalencias.index'));
        }

        $equivalencia->delete();

        Flash::success('Equivalencia deleted successfully.');

        return redirect(route('equivalencias.index'));
    }
}
