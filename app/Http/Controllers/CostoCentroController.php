<?php

namespace App\Http\Controllers;

use App\DataTables\CostoCentroDataTable;
use App\Http\Requests\CreateCostoCentroRequest;
use App\Http\Requests\UpdateCostoCentroRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CostoCentro;
use Illuminate\Http\Request;

class CostoCentroController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Costo Centros')->only('show');
        $this->middleware('permission:Crear Costo Centros')->only(['create','store']);
        $this->middleware('permission:Editar Costo Centros')->only(['edit','update']);
        $this->middleware('permission:Eliminar Costo Centros')->only('destroy');
    }
    /**
     * Display a listing of the CostoCentro.
     */
    public function index(CostoCentroDataTable $costoCentroDataTable)
    {
    return $costoCentroDataTable->render('costo_centros.index');
    }


    /**
     * Show the form for creating a new CostoCentro.
     */
    public function create()
    {
        return view('costo_centros.create');
    }

    /**
     * Store a newly created CostoCentro in storage.
     */
    public function store(CreateCostoCentroRequest $request)
    {
        $input = $request->all();

        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::create($input);

        flash()->success('Costo Centro guardado.');

        return redirect(route('costoCentros.index'));
    }

    /**
     * Display the specified CostoCentro.
     */
    public function show($id)
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            flash()->error('Costo Centro no encontrado');

            return redirect(route('costoCentros.index'));
        }

        return view('costo_centros.show')->with('costoCentro', $costoCentro);
    }

    /**
     * Show the form for editing the specified CostoCentro.
     */
    public function edit($id)
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            flash()->error('Costo Centro no encontrado');

            return redirect(route('costoCentros.index'));
        }

        return view('costo_centros.edit')->with('costoCentro', $costoCentro);
    }

    /**
     * Update the specified CostoCentro in storage.
     */
    public function update($id, UpdateCostoCentroRequest $request)
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            flash()->error('Costo Centro no encontrado');

            return redirect(route('costoCentros.index'));
        }

        $costoCentro->fill($request->all());
        $costoCentro->save();

        flash()->success('Costo Centro actualizado.');

        return redirect(route('costoCentros.index'));
    }

    /**
     * Remove the specified CostoCentro from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CostoCentro $costoCentro */
        $costoCentro = CostoCentro::find($id);

        if (empty($costoCentro)) {
            flash()->error('Costo Centro no encontrado');

            return redirect(route('costoCentros.index'));
        }

        $costoCentro->delete();

        flash()->success('Costo Centro eliminado.');

        return redirect(route('costoCentros.index'));
    }
}
