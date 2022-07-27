<?php

namespace App\Http\Controllers;

use App\DataTables\Compra1hDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCompra1hRequest;
use App\Http\Requests\UpdateCompra1hRequest;
use App\Models\Compra1h;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Compra1hController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra1Hs')->only(['show']);
        $this->middleware('permission:Crear Compra1Hs')->only(['create','store']);
        $this->middleware('permission:Editar Compra1Hs')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Compra1Hs')->only(['destroy']);
    }

    /**
     * Display a listing of the Compra1h.
     *
     * @param Compra1hDataTable $compra1hDataTable
     * @return Response
     */
    public function index(Compra1hDataTable $compra1hDataTable)
    {
        return $compra1hDataTable->render('compra1hs.index');
    }

    /**
     * Show the form for creating a new Compra1h.
     *
     * @return Response
     */
    public function create()
    {
        return view('compra1hs.create');
    }

    /**
     * Store a newly created Compra1h in storage.
     *
     * @param CreateCompra1hRequest $request
     *
     * @return Response
     */
    public function store(CreateCompra1hRequest $request)
    {
        $input = $request->all();

        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::create($input);

        Flash::success('Compra1H guardado exitosamente.');

        return redirect(route('compra1hs.index'));
    }

    /**
     * Display the specified Compra1h.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            Flash::error('Compra1H no encontrado');

            return redirect(route('compra1hs.index'));
        }

        return view('compra1hs.show')->with('compra1h', $compra1h);
    }

    /**
     * Show the form for editing the specified Compra1h.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            Flash::error('Compra1H no encontrado');

            return redirect(route('compra1hs.index'));
        }

        return view('compra1hs.edit')->with('compra1h', $compra1h);
    }

    /**
     * Update the specified Compra1h in storage.
     *
     * @param  int              $id
     * @param UpdateCompra1hRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompra1hRequest $request)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            Flash::error('Compra1H no encontrado');

            return redirect(route('compra1hs.index'));
        }

        $compra1h->fill($request->all());
        $compra1h->save();

        Flash::success('Compra1H actualizado con éxito.');

        return redirect(route('compra1hs.index'));
    }

    /**
     * Remove the specified Compra1h from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            Flash::error('Compra1H no encontrado');

            return redirect(route('compra1hs.index'));
        }

        $compra1h->delete();

        Flash::success('Compra1H deleted successfully.');

        return redirect(route('compra1hs.index'));
    }
}
