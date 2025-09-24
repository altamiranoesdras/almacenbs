<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionSubProductoDataTable;
use App\Http\Requests\CreateRedProduccionSubProductoRequest;
use App\Http\Requests\UpdateRedProduccionSubProductoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionSubProducto;
use Illuminate\Http\Request;

class RedProduccionSubProductoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Produccion Sub Productos')->only('show');
        $this->middleware('permission:Crear Red Produccion Sub Productos')->only(['create','store']);
        $this->middleware('permission:Editar Red Produccion Sub Productos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Produccion Sub Productos')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionSubProducto.
     */
    public function index(RedProduccionSubProductoDataTable $redProduccionSubProductoDataTable)
    {
    return $redProduccionSubProductoDataTable->render('red_produccion_sub_productos.index');
    }


    /**
     * Show the form for creating a new RedProduccionSubProducto.
     */
    public function create()
    {
        return view('red_produccion_sub_productos.create');
    }

    /**
     * Store a newly created RedProduccionSubProducto in storage.
     */
    public function store(CreateRedProduccionSubProductoRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::create($input);

        flash()->success('Red Produccion Sub Producto guardado.');

        return redirect(route('redProduccionSubProductos.index'));
    }

    /**
     * Display the specified RedProduccionSubProducto.
     */
    public function show($id)
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            flash()->error('Red Produccion Sub Producto no encontrado');

            return redirect(route('redProduccionSubProductos.index'));
        }

        return view('red_produccion_sub_productos.show')->with('redProduccionSubProducto', $redProduccionSubProducto);
    }

    /**
     * Show the form for editing the specified RedProduccionSubProducto.
     */
    public function edit($id)
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            flash()->error('Red Produccion Sub Producto no encontrado');

            return redirect(route('redProduccionSubProductos.index'));
        }

        return view('red_produccion_sub_productos.edit')->with('redProduccionSubProducto', $redProduccionSubProducto);
    }

    /**
     * Update the specified RedProduccionSubProducto in storage.
     */
    public function update($id, UpdateRedProduccionSubProductoRequest $request)
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            flash()->error('Red Produccion Sub Producto no encontrado');

            return redirect(route('redProduccionSubProductos.index'));
        }

        $redProduccionSubProducto->fill($request->all());
        $redProduccionSubProducto->save();

        flash()->success('Red Produccion Sub Producto actualizado.');

        return redirect(route('redProduccionSubProductos.index'));
    }

    /**
     * Remove the specified RedProduccionSubProducto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            flash()->error('Red Produccion Sub Producto no encontrado');

            return redirect(route('redProduccionSubProductos.index'));
        }

        $redProduccionSubProducto->delete();

        flash()->success('Red Produccion Sub Producto eliminado.');

        return redirect(route('redProduccionSubProductos.index'));
    }
}
