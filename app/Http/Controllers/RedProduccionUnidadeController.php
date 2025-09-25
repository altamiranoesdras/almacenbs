<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionUnidadeDataTable;
use App\Http\Requests\CreateRedProduccionUnidadeRequest;
use App\Http\Requests\UpdateRedProduccionUnidadeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionUnidade;
use Illuminate\Http\Request;

class RedProduccionUnidadeController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Produccion Unidades')->only('show');
        $this->middleware('permission:Crear Red Produccion Unidades')->only(['create','store']);
        $this->middleware('permission:Editar Red Produccion Unidades')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Produccion Unidades')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionUnidade.
     */
    public function index(RedProduccionUnidadeDataTable $redProduccionUnidadeDataTable)
    {
    return $redProduccionUnidadeDataTable->render('red_produccion_unidades.index');
    }


    /**
     * Show the form for creating a new RedProduccionUnidade.
     */
    public function create()
    {
        return view('red_produccion_unidades.create');
    }

    /**
     * Store a newly created RedProduccionUnidade in storage.
     */
    public function store(CreateRedProduccionUnidadeRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionUnidade $redProduccionUnidade */
        $redProduccionUnidade = RedProduccionUnidade::create($input);

        flash()->success('Red Produccion Unidade guardado.');

        return redirect(route('redProduccionUnidades.index'));
    }

    /**
     * Display the specified RedProduccionUnidade.
     */
    public function show($id)
    {
        /** @var RedProduccionUnidade $redProduccionUnidade */
        $redProduccionUnidade = RedProduccionUnidade::find($id);

        if (empty($redProduccionUnidade)) {
            flash()->error('Red Produccion Unidade no encontrado');

            return redirect(route('redProduccionUnidades.index'));
        }

        return view('red_produccion_unidades.show')->with('redProduccionUnidade', $redProduccionUnidade);
    }

    /**
     * Show the form for editing the specified RedProduccionUnidade.
     */
    public function edit($id)
    {
        /** @var RedProduccionUnidade $redProduccionUnidade */
        $redProduccionUnidade = RedProduccionUnidade::find($id);

        if (empty($redProduccionUnidade)) {
            flash()->error('Red Produccion Unidade no encontrado');

            return redirect(route('redProduccionUnidades.index'));
        }

        return view('red_produccion_unidades.edit')->with('redProduccionUnidade', $redProduccionUnidade);
    }

    /**
     * Update the specified RedProduccionUnidade in storage.
     */
    public function update($id, UpdateRedProduccionUnidadeRequest $request)
    {
        /** @var RedProduccionUnidade $redProduccionUnidade */
        $redProduccionUnidade = RedProduccionUnidade::find($id);

        if (empty($redProduccionUnidade)) {
            flash()->error('Red Produccion Unidade no encontrado');

            return redirect(route('redProduccionUnidades.index'));
        }

        $redProduccionUnidade->fill($request->all());
        $redProduccionUnidade->save();

        flash()->success('Red Produccion Unidade actualizado.');

        return redirect(route('redProduccionUnidades.index'));
    }

    /**
     * Remove the specified RedProduccionUnidade from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionUnidade $redProduccionUnidade */
        $redProduccionUnidade = RedProduccionUnidade::find($id);

        if (empty($redProduccionUnidade)) {
            flash()->error('Red Produccion Unidade no encontrado');

            return redirect(route('redProduccionUnidades.index'));
        }

        $redProduccionUnidade->delete();

        flash()->success('Red Produccion Unidade eliminado.');

        return redirect(route('redProduccionUnidades.index'));
    }
}
