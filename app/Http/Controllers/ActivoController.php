<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use App\Imports\ActivosImport;
use App\Models\Activo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;
use Response;

class ActivoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activos')->only(['show']);
        $this->middleware('permission:Crear Activos')->only(['create','store']);
        $this->middleware('permission:Editar Activos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activos')->only(['destroy']);
    }

    /**
     * Display a listing of the Activo.
     *
     * @param ActivoDataTable $activoDataTable
     * @return Response
     */
    public function index(ActivoDataTable $activoDataTable)
    {
        return $activoDataTable->render('activos.index');
    }

    /**
     * Show the form for creating a new Activo.
     *
     * @return Response
     */
    public function create()
    {
        return view('activos.create');
    }

    /**
     * Store a newly created Activo in storage.
     *
     * @param CreateActivoRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoRequest $request)
    {
        $input = $request->all();

        /** @var Activo $activo */
        $activo = Activo::create($input);

        if ($request->hasFile('imagen')){
            $activo->addMediaFromRequest('imagen')->toMediaCollection('activos');
        }

        Flash::success('Activo guardado exitosamente.');

        return redirect(route('activos.index'));
    }

    /**
     * Display the specified Activo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        return view('activos.show')->with('activo', $activo);
    }

    /**
     * Show the form for editing the specified Activo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        return view('activos.edit')->with('activo', $activo);
    }

    /**
     * Update the specified Activo in storage.
     *
     * @param  int              $id
     * @param UpdateActivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoRequest $request)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        $activo->fill($request->all());
        $activo->save();


        if ($request->hasFile('imagen')){
            $activo->addMediaFromRequest('imagen')->toMediaCollection('activos');
        }

        Flash::success('Activo actualizado con éxito.');

        return redirect(route('activos.index'));
    }

    /**
     * Remove the specified Activo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Activo $activo */
        $activo = Activo::find($id);

        if (empty($activo)) {
            Flash::error('Activo no encontrado');

            return redirect(route('activos.index'));
        }

        $activo->delete();

        Flash::success('Activo deleted successfully.');

        return redirect(route('activos.index'));
    }

    public function importar()
    {
        return view('activos.import');
    }

    public function importarStore(Request $request)
    {

        try {
            DB::beginTransaction();

            $import = new ActivosImport();

            $import->import($request->file('file'));

        }
        catch (ValidationException $e) {
            DB::rollBack();
            $erros = array();
            foreach ($e->failures() as $failure) {
                $erros[] = "Error en fila ".$failure->row().": ".implode($failure->errors());
            }

            flash('error', 'Ocurrio un error al intentar importar los datos!')->error();

            return redirect()->back()->withErrors(['REVISA EL ENCABEZADO Y/O PIE DEL ARCHIVO.', 'Ocurrio un error en los datos y/o la estructura del archivo.', $erros]);
        }
        catch (Exception $e){


            DB::rollBack();

            throw $e;

            return redirect()->back()->withErrors(['ERROR AL TRATAR DE LEER EL ARCHIVO.','REVISA QUE EL ARCHIVO TENGA EL FORMATO CORRECTO.']);
        }

        DB::commit();

        flash('Datos Importados con Exito!')->success();

        return redirect(route('activos.importar'));

    }

}
