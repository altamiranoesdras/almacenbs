<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionProductoDataTable;
use App\Http\Requests\CreateRedProduccionProductoRequest;
use App\Http\Requests\UpdateRedProduccionProductoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionProducto;
use Illuminate\Http\Request;

class RedProduccionProductoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Produccion Productos')->only('show');
        $this->middleware('permission:Crear Red Produccion Productos')->only(['create','store']);
        $this->middleware('permission:Editar Red Produccion Productos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Produccion Productos')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionProducto.
     */
    public function index(RedProduccionProductoDataTable $redProduccionProductoDataTable)
    {
    return $redProduccionProductoDataTable->render('red_produccion_productos.index');
    }


    /**
     * Show the form for creating a new RedProduccionProducto.
     */
    public function create()
    {
        return view('red_produccion_productos.create');
    }

    /**
     * Store a newly created RedProduccionProducto in storage.
     */
    public function store(CreateRedProduccionProductoRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::create($input);

        flash()->success('Red Produccion Producto guardado.');

        return redirect(route('redProduccionProductos.index'));
    }

    /**
     * Display the specified RedProduccionProducto.
     */
    public function show($id)
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            flash()->error('Red Produccion Producto no encontrado');

            return redirect(route('redProduccionProductos.index'));
        }

        return view('red_produccion_productos.show')->with('redProduccionProducto', $redProduccionProducto);
    }

    /**
     * Show the form for editing the specified RedProduccionProducto.
     */
    public function edit($id)
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            flash()->error('Red Produccion Producto no encontrado');

            return redirect(route('redProduccionProductos.index'));
        }

        return view('red_produccion_productos.edit')->with('redProduccionProducto', $redProduccionProducto);
    }

    /**
     * Update the specified RedProduccionProducto in storage.
     */
    public function update($id, UpdateRedProduccionProductoRequest $request)
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            flash()->error('Red Produccion Producto no encontrado');

            return redirect(route('redProduccionProductos.index'));
        }

        $redProduccionProducto->fill($request->all());
        $redProduccionProducto->save();

        flash()->success('Red Produccion Producto actualizado.');

        return redirect(route('redProduccionProductos.index'));
    }

    /**
     * Remove the specified RedProduccionProducto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionProducto $redProduccionProducto */
        $redProduccionProducto = RedProduccionProducto::find($id);

        if (empty($redProduccionProducto)) {
            flash()->error('Red Produccion Producto no encontrado');

            return redirect(route('redProduccionProductos.index'));
        }

        $redProduccionProducto->delete();

        flash()->success('Red Produccion Producto eliminado.');

        return redirect(route('redProduccionProductos.index'));
    }
}
