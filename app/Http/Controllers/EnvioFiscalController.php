<?php

namespace App\Http\Controllers;

use App\DataTables\EnvioFiscalDataTable;
use App\Http\Requests\CreateEnvioFiscalRequest;
use App\Http\Requests\UpdateEnvioFiscalRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\EnvioFiscal;
use Illuminate\Http\Request;

class EnvioFiscalController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Envio Fiscals')->only('show');
        $this->middleware('permission:Crear Envio Fiscals')->only(['create','store']);
        $this->middleware('permission:Editar Envio Fiscals')->only(['edit','update']);
        $this->middleware('permission:Eliminar Envio Fiscals')->only('destroy');
    }
    /**
     * Display a listing of the EnvioFiscal.
     */
    public function index(EnvioFiscalDataTable $envioFiscalDataTable)
    {
    return $envioFiscalDataTable->render('envio_fiscals.index');
    }


    /**
     * Show the form for creating a new EnvioFiscal.
     */
    public function create()
    {
        return view('envio_fiscals.create');
    }

    /**
     * Store a newly created EnvioFiscal in storage.
     */
    public function store(CreateEnvioFiscalRequest $request)
    {
        $input = $request->all();

        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::create($input);

        flash()->success('Envio Fiscal guardado.');

        return redirect(route('envioFiscals.index'));
    }

    /**
     * Display the specified EnvioFiscal.
     */
    public function show($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            flash()->error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        return view('envio_fiscals.show')->with('envioFiscal', $envioFiscal);
    }

    /**
     * Show the form for editing the specified EnvioFiscal.
     */
    public function edit($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            flash()->error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        return view('envio_fiscals.edit')->with('envioFiscal', $envioFiscal);
    }

    /**
     * Update the specified EnvioFiscal in storage.
     */
    public function update($id, UpdateEnvioFiscalRequest $request)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            flash()->error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        $envioFiscal->fill($request->all());
        $envioFiscal->save();

        flash()->success('Envio Fiscal actualizado.');

        return redirect(route('envioFiscals.index'));
    }

    /**
     * Remove the specified EnvioFiscal from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            flash()->error('Envio Fiscal no encontrado');

            return redirect(route('envioFiscals.index'));
        }

        $envioFiscal->delete();

        flash()->success('Envio Fiscal eliminado.');

        return redirect(route('envioFiscals.index'));
    }
}
