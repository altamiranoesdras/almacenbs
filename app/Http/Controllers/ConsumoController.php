<?php

namespace App\Http\Controllers;

use App\DataTables\ConsumoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConsumoRequest;
use App\Http\Requests\UpdateConsumoRequest;
use App\Models\Consumo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ConsumoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Consumos')->only(['show']);
        $this->middleware('permission:Crear Consumos')->only(['create','store']);
        $this->middleware('permission:Editar Consumos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Consumos')->only(['destroy']);
    }

    /**
     * Display a listing of the Consumo.
     *
     * @param ConsumoDataTable $consumoDataTable
     * @return Response
     */
    public function index(ConsumoDataTable $consumoDataTable)
    {
        return $consumoDataTable->render('consumos.index');
    }

    /**
     * Show the form for creating a new Consumo.
     *
     * @return Response
     */
    public function create()
    {
        return view('consumos.create');
    }

    /**
     * Store a newly created Consumo in storage.
     *
     * @param CreateConsumoRequest $request
     *
     * @return Response
     */
    public function store(CreateConsumoRequest $request)
    {
        $input = $request->all();

        /** @var Consumo $consumo */
        $consumo = Consumo::create($input);

        Flash::success('Consumo guardado exitosamente.');

        return redirect(route('consumos.index'));
    }

    /**
     * Display the specified Consumo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        return view('consumos.show')->with('consumo', $consumo);
    }

    /**
     * Show the form for editing the specified Consumo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        return view('consumos.edit')->with('consumo', $consumo);
    }

    /**
     * Update the specified Consumo in storage.
     *
     * @param  int              $id
     * @param UpdateConsumoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConsumoRequest $request)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        $consumo->fill($request->all());
        $consumo->save();

        Flash::success('Consumo actualizado con éxito.');

        return redirect(route('consumos.index'));
    }

    /**
     * Remove the specified Consumo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Consumo $consumo */
        $consumo = Consumo::find($id);

        if (empty($consumo)) {
            Flash::error('Consumo no encontrado');

            return redirect(route('consumos.index'));
        }

        $consumo->delete();

        Flash::success('Consumo deleted successfully.');

        return redirect(route('consumos.index'));
    }
}
