<?php

namespace App\Http\Controllers;

use App\DataTables\CompraBandejaDataTable;
use App\Http\Requests\CreateCompraBandejaRequest;
use App\Http\Requests\UpdateCompraBandejaRequest;
use App\Models\CompraBandeja;

class CompraBandejaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Bandejas')->only('show');
        $this->middleware('permission:Crear Compra Bandejas')->only(['create','store']);
        $this->middleware('permission:Editar Compra Bandejas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Bandejas')->only('destroy');
    }
    /**
     * Display a listing of the CompraBandeja.
     */
    public function index(CompraBandejaDataTable $compraBandejaDataTable)
    {
    return $compraBandejaDataTable->render('compra_bandejas.index');
    }


    /**
     * Show the form for creating a new CompraBandeja.
     */
    public function create()
    {
        return view('compra_bandejas.create');
    }

    /**
     * Store a newly created CompraBandeja in storage.
     */
    public function store(CreateCompraBandejaRequest $request)
    {
        $input = $request->all();

        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::create($input);

        flash()->success('Compra Bandeja guardado.');

        return redirect(route('compra.bandejas.index'));
    }

    /**
     * Display the specified CompraBandeja.
     */
    public function show($id)
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            flash()->error('Compra Bandeja no encontrado');

            return redirect(route('compra.bandejas.index'));
        }

        return view('compra_bandejas.show')->with('compraBandeja', $compraBandeja);
    }

    /**
     * Show the form for editing the specified CompraBandeja.
     */
    public function edit($id)
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            flash()->error('Compra Bandeja no encontrado');

            return redirect(route('compra.bandejas.index'));
        }

        return view('compra_bandejas.edit')->with('compraBandeja', $compraBandeja);
    }

    /**
     * Update the specified CompraBandeja in storage.
     */
    public function update($id, UpdateCompraBandejaRequest $request)
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            flash()->error('Compra Bandeja no encontrado');

            return redirect(route('compra.bandejas.index'));
        }

        $compraBandeja->fill($request->all());
        $compraBandeja->save();

        flash()->success('Compra Bandeja actualizado.');

        return redirect(route('compra.bandejas.index'));
    }

    /**
     * Remove the specified CompraBandeja from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraBandeja $compraBandeja */
        $compraBandeja = CompraBandeja::find($id);

        if (empty($compraBandeja)) {
            flash()->error('Compra Bandeja no encontrado');

            return redirect(route('compra.bandejas.index'));
        }

        $compraBandeja->delete();

        flash()->success('Compra Bandeja eliminado.');

        return redirect(route('compra.bandejas.index'));
    }
}
