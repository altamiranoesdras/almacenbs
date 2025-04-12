<?php

namespace App\Http\Controllers;

use App\DataTables\ConfigurationDataTable;
use App\Http\Requests\CreateConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Configurations')->only('show');
        $this->middleware('permission:Crear Configurations')->only(['create','store']);
        $this->middleware('permission:Editar Configurations')->only(['edit','update']);
        $this->middleware('permission:Eliminar Configurations')->only('destroy');
    }
    /**
     * Display a listing of the Configuration.
     */
    public function index(ConfigurationDataTable $configurationDataTable)
    {
    return $configurationDataTable->render('configurations.index');
    }


    /**
     * Show the form for creating a new Configuration.
     */
    public function create()
    {
        return view('configurations.create');
    }

    /**
     * Store a newly created Configuration in storage.
     */
    public function store(CreateConfigurationRequest $request)
    {
        $input = $request->all();

        /** @var Configuration $configuration */
        $configuration = Configuration::create($input);

        flash()->success('Configuration guardado.');

        return redirect(route('configurations.index'));
    }

    /**
     * Display the specified Configuration.
     */
    public function show($id)
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            flash()->error('Configuration no encontrado');

            return redirect(route('configurations.index'));
        }

        return view('configurations.show')->with('configuration', $configuration);
    }

    /**
     * Show the form for editing the specified Configuration.
     */
    public function edit($id)
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            flash()->error('Configuration no encontrado');

            return redirect(route('configurations.index'));
        }

        return view('configurations.edit')->with('configuration', $configuration);
    }

    /**
     * Update the specified Configuration in storage.
     */
    public function update($id, UpdateConfigurationRequest $request)
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            flash()->error('Configuration no encontrado');

            return redirect(route('configurations.index'));
        }

        $configuration->fill($request->all());
        $configuration->save();

        flash()->success('Configuration actualizado.');

        return redirect(route('configurations.index'));
    }

    /**
     * Remove the specified Configuration from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            flash()->error('Configuration no encontrado');

            return redirect(route('configurations.index'));
        }

        $configuration->delete();

        flash()->success('Configuration eliminado.');

        return redirect(route('configurations.index'));
    }
}
