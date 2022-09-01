<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoTarjetaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoTarjetaRequest;
use App\Http\Requests\UpdateActivoTarjetaRequest;
use App\Models\ActivoTarjeta;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ActivoTarjetaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Tarjetas')->only(['show']);
        $this->middleware('permission:Crear Activo Tarjetas')->only(['create','store']);
        $this->middleware('permission:Editar Activo Tarjetas')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Tarjetas')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoTarjeta.
     *
     * @param ActivoTarjetaDataTable $activoTarjetaDataTable
     * @return Response
     */
    public function index(ActivoTarjetaDataTable $activoTarjetaDataTable)
    {
        return $activoTarjetaDataTable->render('activo_tarjetas.index');
    }

    /**
     * Show the form for creating a new ActivoTarjeta.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_tarjetas.create');
    }

    /**
     * Store a newly created ActivoTarjeta in storage.
     *
     * @param CreateActivoTarjetaRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::create($input);

        Flash::success('Activo Tarjeta guardado exitosamente.');

        return redirect(route('activoTarjetas.index'));
    }

    /**
     * Display the specified ActivoTarjeta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        return view('activo_tarjetas.show')->with('activoTarjeta', $activoTarjeta);
    }

    /**
     * Show the form for editing the specified ActivoTarjeta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        return view('activo_tarjetas.edit')->with('activoTarjeta', $activoTarjeta);
    }

    /**
     * Update the specified ActivoTarjeta in storage.
     *
     * @param  int              $id
     * @param UpdateActivoTarjetaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaRequest $request)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        $activoTarjeta->fill($request->all());
        $activoTarjeta->save();

        Flash::success('Activo Tarjeta actualizado con éxito.');

        return redirect(route('activoTarjetas.index'));
    }

    /**
     * Remove the specified ActivoTarjeta from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        $activoTarjeta->delete();

        Flash::success('Activo Tarjeta deleted successfully.');

        return redirect(route('activoTarjetas.index'));
    }
}
