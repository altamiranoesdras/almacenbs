<?php

namespace App\Http\Controllers;

use App\DataTables\EnvioFiscalDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEnvioFiscalRequest;
use App\Http\Requests\UpdateEnvioFiscalRequest;
use App\Models\EnvioFiscal;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EnvioFiscalController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Envio Fiscals')->only(['show']);
        $this->middleware('permission:Crear Envio Fiscals')->only(['create','store']);
        $this->middleware('permission:Editar Envio Fiscals')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Envio Fiscals')->only(['destroy']);
    }

    /**
     * Display a listing of the EnvioFiscal.
     *
     * @param EnvioFiscalDataTable $envioFiscalDataTable
     * @return Response
     */
    public function index(EnvioFiscalDataTable $envioFiscalDataTable)
    {
        return $envioFiscalDataTable->render('envio_fiscals.index');
    }

    /**
     * Show the form for creating a new EnvioFiscal.
     *
     * @return Response
     */
    public function create()
    {
        return view('envio_fiscals.create');
    }

    /**
     * Store a newly created EnvioFiscal in storage.
     *
     * @param CreateEnvioFiscalRequest $request
     *
     * @return Response
     */
    public function store(CreateEnvioFiscalRequest $request)
    {
        $input = $request->all();

        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::create($input);

        Flash::success('Envio Fiscal guardado exitosamente.');

        return redirect(route('envioFiscals.index'));
    }

    /**
     * Display the specified EnvioFiscal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            Flash::error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        return view('envio_fiscals.show')->with('envioFiscal', $envioFiscal);
    }

    /**
     * Show the form for editing the specified EnvioFiscal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            Flash::error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        return view('envio_fiscals.edit')->with('envioFiscal', $envioFiscal);
    }

    /**
     * Update the specified EnvioFiscal in storage.
     *
     * @param  int              $id
     * @param UpdateEnvioFiscalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnvioFiscalRequest $request)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            Flash::error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        $envioFiscal->fill($request->all());
        $envioFiscal->save();

        Flash::success('Envio Fiscal actualizado con éxito.');

        return redirect(route('envioFiscals.index'));
    }

    /**
     * Remove the specified EnvioFiscal from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            Flash::error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        $envioFiscal->delete();

        Flash::success('Envio Fiscal deleted successfully.');

        return redirect(route('envioFiscals.index'));
    }
}
