<?php

namespace App\Http\Controllers;

use App\DataTables\ColaboradorDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateColaboradorRequest;
use App\Http\Requests\UpdateColaboradorRequest;
use App\Models\Colaborador;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ColaboradorController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Colaboradors')->only(['show']);
        $this->middleware('permission:Crear Colaboradors')->only(['create','store']);
        $this->middleware('permission:Editar Colaboradors')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Colaboradors')->only(['destroy']);
    }

    /**
     * Display a listing of the Colaborador.
     *
     * @param ColaboradorDataTable $colaboradorDataTable
     * @return Response
     */
    public function index(ColaboradorDataTable $colaboradorDataTable)
    {
        return $colaboradorDataTable->render('colaboradors.index');
    }

    /**
     * Show the form for creating a new Colaborador.
     *
     * @return Response
     */
    public function create()
    {
        return view('colaboradors.create');
    }

    /**
     * Store a newly created Colaborador in storage.
     *
     * @param CreateColaboradorRequest $request
     *
     * @return Response
     */
    public function store(CreateColaboradorRequest $request)
    {
        $input = $request->all();

        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::create($input);

        Flash::success('Colaborador guardado exitosamente.');

        return redirect(route('colaboradors.index'));
    }

    /**
     * Display the specified Colaborador.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            Flash::error('Colaborador no encontrado');

            return redirect(route('colaboradors.index'));
        }

        return view('colaboradors.show')->with('colaborador', $colaborador);
    }

    /**
     * Show the form for editing the specified Colaborador.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            Flash::error('Colaborador no encontrado');

            return redirect(route('colaboradors.index'));
        }

        return view('colaboradors.edit')->with('colaborador', $colaborador);
    }

    /**
     * Update the specified Colaborador in storage.
     *
     * @param  int              $id
     * @param UpdateColaboradorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateColaboradorRequest $request)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            Flash::error('Colaborador no encontrado');

            return redirect(route('colaboradors.index'));
        }

        $colaborador->fill($request->all());
        $colaborador->save();

        Flash::success('Colaborador actualizado con éxito.');

        return redirect(route('colaboradors.index'));
    }

    /**
     * Remove the specified Colaborador from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = Colaborador::find($id);

        if (empty($colaborador)) {
            Flash::error('Colaborador no encontrado');

            return redirect(route('colaboradors.index'));
        }

        $colaborador->delete();

        Flash::success('Colaborador deleted successfully.');

        return redirect(route('colaboradors.index'));
    }
}
