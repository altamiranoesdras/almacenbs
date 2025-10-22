<?php

namespace App\Http\Controllers;

use App\DataTables\RegionDataTable;
use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Regions')->only('show');
        $this->middleware('permission:Crear Regions')->only(['create','store']);
        $this->middleware('permission:Editar Regions')->only(['edit','update']);
        $this->middleware('permission:Eliminar Regions')->only('destroy');
    }
    /**
     * Display a listing of the Region.
     */
    public function index(RegionDataTable $regionDataTable)
    {
    return $regionDataTable->render('Regiones.index');
    }


    /**
     * Show the form for creating a new Region.
     */
    public function create()
    {
        return view('Regiones.create');
    }

    /**
     * Store a newly created Region in storage.
     */
    public function store(CreateRegionRequest $request)
    {
        $input = $request->all();

        /** @var Region $region */
        $region = Region::create($input);

        flash()->success('Region guardado.');

        return redirect(route('regiones.index'));
    }

    /**
     * Display the specified Region.
     */
    public function show($id)
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            flash()->error('Region no encontrado');

            return redirect(route('regiones.index'));
        }

        return view('Regiones.show')->with('region', $region);
    }

    /**
     * Show the form for editing the specified Region.
     */
    public function edit($id)
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            flash()->error('Region no encontrado');

            return redirect(route('regiones.index'));
        }

        return view('Regiones.edit')->with('region', $region);
    }

    /**
     * Update the specified Region in storage.
     */
    public function update($id, UpdateRegionRequest $request)
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            flash()->error('Region no encontrado');

            return redirect(route('regiones.index'));
        }

        $region->fill($request->all());
        $region->save();

        flash()->success('Region actualizado.');

        return redirect(route('regiones.index'));
    }

    /**
     * Remove the specified Region from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Region $region */
        $region = Region::find($id);

        if (empty($region)) {
            flash()->error('Region no encontrado');

            return redirect(route('regiones.index'));
        }

        $region->delete();

        flash()->success('Region eliminado.');

        return redirect(route('regiones.index'));
    }
}
