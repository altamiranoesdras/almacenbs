<?php

namespace App\Http\Controllers;

use App\DataTables\ConsumoEstadoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConsumoEstadoRequest;
use App\Http\Requests\UpdateConsumoEstadoRequest;
use App\Models\ConsumoEstado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ConsumoEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Consumo Estados')->only(['show']);
        $this->middleware('permission:Crear Consumo Estados')->only(['create','store']);
        $this->middleware('permission:Editar Consumo Estados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Consumo Estados')->only(['destroy']);
    }

    /**
     * Display a listing of the ConsumoEstado.
     *
     * @param ConsumoEstadoDataTable $consumoEstadoDataTable
     * @return Response
     */
    public function index(ConsumoEstadoDataTable $consumoEstadoDataTable)
    {
        return $consumoEstadoDataTable->render('consumo_estados.index');
    }

    /**
     * Show the form for creating a new ConsumoEstado.
     *
     * @return Response
     */
    public function create()
    {
        return view('consumo_estados.create');
    }

    /**
     * Store a newly created ConsumoEstado in storage.
     *
     * @param CreateConsumoEstadoRequest $request
     *
     * @return Response
     */
    public function store(CreateConsumoEstadoRequest $request)
    {
        $input = $request->all();

        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::create($input);

        Flash::success('Consumo Estado guardado exitosamente.');

        return redirect(route('consumoEstados.index'));
    }

    /**
     * Display the specified ConsumoEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            Flash::error('Consumo Estado no encontrado');

            return redirect(route('consumoEstados.index'));
        }

        return view('consumo_estados.show')->with('consumoEstado', $consumoEstado);
    }

    /**
     * Show the form for editing the specified ConsumoEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            Flash::error('Consumo Estado no encontrado');

            return redirect(route('consumoEstados.index'));
        }

        return view('consumo_estados.edit')->with('consumoEstado', $consumoEstado);
    }

    /**
     * Update the specified ConsumoEstado in storage.
     *
     * @param  int              $id
     * @param UpdateConsumoEstadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConsumoEstadoRequest $request)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            Flash::error('Consumo Estado no encontrado');

            return redirect(route('consumoEstados.index'));
        }

        $consumoEstado->fill($request->all());
        $consumoEstado->save();

        Flash::success('Consumo Estado actualizado con éxito.');

        return redirect(route('consumoEstados.index'));
    }

    /**
     * Remove the specified ConsumoEstado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ConsumoEstado $consumoEstado */
        $consumoEstado = ConsumoEstado::find($id);

        if (empty($consumoEstado)) {
            Flash::error('Consumo Estado no encontrado');

            return redirect(route('consumoEstados.index'));
        }

        $consumoEstado->delete();

        Flash::success('Consumo Estado deleted successfully.');

        return redirect(route('consumoEstados.index'));
    }
}
