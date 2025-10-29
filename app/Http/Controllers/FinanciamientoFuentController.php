<?php

namespace App\Http\Controllers;

use App\DataTables\FinanciamientoFuentDataTable;
use App\Http\Requests\CreateFinanciamientoFuentRequest;
use App\Http\Requests\UpdateFinanciamientoFuentRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\FinanciamientoFuent;
use Illuminate\Http\Request;

class FinanciamientoFuentController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Financiamiento Fuents')->only('show');
        $this->middleware('permission:Crear Financiamiento Fuents')->only(['create','store']);
        $this->middleware('permission:Editar Financiamiento Fuents')->only(['edit','update']);
        $this->middleware('permission:Eliminar Financiamiento Fuents')->only('destroy');
    }
    /**
     * Display a listing of the FinanciamientoFuent.
     */
    public function index(FinanciamientoFuentDataTable $financiamientoFuentDataTable)
    {
    return $financiamientoFuentDataTable->render('financiamiento_fuentes.index');
    }


    /**
     * Show the form for creating a new FinanciamientoFuent.
     */
    public function create()
    {
        return view('financiamiento_fuentes.create');
    }

    /**
     * Store a newly created FinanciamientoFuent in storage.
     */
    public function store(CreateFinanciamientoFuentRequest $request)
    {
        $input = $request->all();

        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::create($input);

        flash()->success('Financiamiento Fuent guardado.');

        return redirect(route('financiamientoFuentes.index'));
    }

    /**
     * Display the specified FinanciamientoFuent.
     */
    public function show($id)
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            flash()->error('Financiamiento Fuent no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        return view('financiamiento_fuentes.show')->with('financiamientoFuent', $financiamientoFuent);
    }

    /**
     * Show the form for editing the specified FinanciamientoFuent.
     */
    public function edit($id)
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            flash()->error('Financiamiento Fuent no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        return view('financiamiento_fuentes.edit')->with('financiamientoFuent', $financiamientoFuent);
    }

    /**
     * Update the specified FinanciamientoFuent in storage.
     */
    public function update($id, UpdateFinanciamientoFuentRequest $request)
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            flash()->error('Financiamiento Fuent no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        $financiamientoFuent->fill($request->all());
        $financiamientoFuent->save();

        flash()->success('Financiamiento Fuent actualizado.');

        return redirect(route('financiamientoFuentes.index'));
    }

    /**
     * Remove the specified FinanciamientoFuent from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            flash()->error('Financiamiento Fuent no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        $financiamientoFuent->delete();

        flash()->success('Financiamiento Fuent eliminado.');

        return redirect(route('financiamientoFuentes.index'));
    }
}
