<?php

namespace App\Http\Controllers;

use App\DataTables\ProveedorDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProveedorController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Proveedores')->only(['show']);
        $this->middleware('permission:Crear Proveedores')->only(['create','store']);
        $this->middleware('permission:Editar Proveedores')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Proveedores')->only(['destroy']);
    }

    /**
     * Display a listing of the Proveedor.
     *
     * @param ProveedorDataTable $proveedorDataTable
     * @return Response
     */
    public function index(ProveedorDataTable $proveedorDataTable)
    {
        return $proveedorDataTable->render('proveedores.index');
    }

    /**
     * Show the form for creating a new Proveedor.
     *
     * @return Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created Proveedor in storage.
     *
     * @param CreateProveedorRequest $request
     *
     * @return Response
     */
    public function store(CreateProveedorRequest $request)
    {
        $input = $request->all();

        /** @var Proveedor $proveedor */
        $proveedor = Proveedor::create($input);

        Flash::success('Proveedor guardado exitosamente.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Display the specified Proveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Proveedor $proveedor */
        $proveedor = Proveedor::find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedor no encontrado');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.show')->with('proveedor', $proveedor);
    }

    /**
     * Show the form for editing the specified Proveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Proveedor $proveedor */
        $proveedor = Proveedor::find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedor no encontrado');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.edit')->with('proveedor', $proveedor);
    }

    /**
     * Update the specified Proveedor in storage.
     *
     * @param  int              $id
     * @param UpdateProveedorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProveedorRequest $request)
    {
        /** @var Proveedor $proveedor */
        $proveedor = Proveedor::find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedor no encontrado');

            return redirect(route('proveedores.index'));
        }

        $proveedor->fill($request->all());
        $proveedor->save();

        Flash::success('Proveedor actualizado con éxito.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Remove the specified Proveedor from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Proveedor $proveedor */
        $proveedor = Proveedor::find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedor no encontrado');

            return redirect(route('proveedores.index'));
        }

        $proveedor->delete();

        Flash::success('Proveedor deleted successfully.');

        return redirect(route('proveedores.index'));
    }
}
