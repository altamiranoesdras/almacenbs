<?php

namespace App\Http\Controllers;

use App\DataTables\CompraDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\Compra;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CompraController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compras')->only(['show']);
        $this->middleware('permission:Crear Compras')->only(['create','store']);
        $this->middleware('permission:Editar Compras')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Compras')->only(['destroy']);
    }

    /**
     * Display a listing of the Compra.
     *
     * @param CompraDataTable $compraDataTable
     * @return Response
     */
    public function index(CompraDataTable $compraDataTable)
    {
        return $compraDataTable->render('compras.index');
    }

    /**
     * Show the form for creating a new Compra.
     *
     * @return Response
     */
    public function create()
    {
        return view('compras.create');
    }

    /**
     * Store a newly created Compra in storage.
     *
     * @param CreateCompraRequest $request
     *
     * @return Response
     */
    public function store(CreateCompraRequest $request)
    {
        $input = $request->all();

        /** @var Compra $compra */
        $compra = Compra::create($input);

        Flash::success('Compra guardado exitosamente.');

        return redirect(route('compras.index'));
    }

    /**
     * Display the specified Compra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            Flash::error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        return view('compras.show')->with('compra', $compra);
    }

    /**
     * Show the form for editing the specified Compra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            Flash::error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        return view('compras.edit')->with('compra', $compra);
    }

    /**
     * Update the specified Compra in storage.
     *
     * @param  int              $id
     * @param UpdateCompraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompraRequest $request)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            Flash::error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        $compra->fill($request->all());
        $compra->save();

        Flash::success('Compra actualizado con éxito.');

        return redirect(route('compras.index'));
    }

    /**
     * Remove the specified Compra from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Compra $compra */
        $compra = Compra::find($id);

        if (empty($compra)) {
            Flash::error('Compra no encontrado');

            return redirect(route('compras.index'));
        }

        $compra->delete();

        Flash::success('Compra deleted successfully.');

        return redirect(route('compras.index'));
    }
}
