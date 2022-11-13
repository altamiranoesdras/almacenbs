<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoSolicitudDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoSolicitudRequest;
use App\Http\Requests\UpdateActivoSolicitudRequest;
use App\Models\ActivoSolicitud;
use App\Models\ActivoSolicitudEstado;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;

class ActivoSolicitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Solicitudes')->only(['show']);
        $this->middleware('permission:Crear Activo Solicitudes')->only(['create','store']);
        $this->middleware('permission:Editar Activo Solicitudes')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Solicitudes')->only(['destroy']);
        $this->middleware('permission:anular ingreso de solicitud activos')->only(['anular']);
    }

    /**
     * Display a listing of the ActivoSolicitud.
     *
     * @param ActivoSolicitudDataTable $activoSolicitudDataTable
     * @return Response
     */
    public function index(ActivoSolicitudDataTable $activoSolicitudDataTable)
    {
        return $activoSolicitudDataTable->render('activo_solicituds.index');
    }

    /**
     * Show the form for creating a new ActivoSolicitud.
     *
     * @return Response
     */
    public function create()
    {
        $temporal = $this->activoSolicitudTemporal();

        return view('activo_solicituds.create', compact('temporal'));
    }

    /**
     * Store a newly created ActivoSolicitud in storage.
     *
     * @param CreateActivoSolicitudRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoSolicitudRequest $request)
    {
        return $request->all();
        $input = $request->all();

        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::create($input);

        Flash::success('Activo Solicitud guardado exitosamente.');

        return redirect(route('activoSolicitudes.index'));
    }

    /**
     * Display the specified ActivoSolicitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        return view('activo_solicituds.show')->with('activoSolicitud', $activoSolicitud);
    }

    /**
     * Show the form for editing the specified ActivoSolicitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        return view('activo_solicituds.editV2')->with('activoSolicitud', $activoSolicitud);
    }

    /**
     * Update the specified ActivoSolicitud in storage.
     *
     * @param  int              $id
     * @param UpdateActivoSolicitudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoSolicitudRequest $request)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        try {
            DB::beginTransaction();

            $this->procesar($activoSolicitud, $request);

        } catch (\Exception $exception) {

            DB::rollBack();

            if (auth()->user()->isDev()){
                throw $exception;
            }

            flash("Hubo un error intente de nuevo")->error();

            return redirect()->back();
        }

        DB::commit();

        Flash::success('Activo Solicitud actualizado con éxito.');

        return redirect(route('activoSolicitudes.index'));
    }

    public function procesar(ActivoSolicitud $activoSolicitud,UpdateActivoSolicitudRequest $request){

        $request->merge([
            'estado_id' => ActivoSolicitudEstado::INGRESADA,
            'codigo' => $this->getCodigo(),
            'correlativo' => $this->getCorrelativo(),
        ]);

        $activoSolicitud->fill($request->all());
        $activoSolicitud->save();

        return $activoSolicitud;

    }

    /**
     * Remove the specified ActivoSolicitud from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoSolicitud $activoSolicitud */
        $activoSolicitud = ActivoSolicitud::find($id);

        if (empty($activoSolicitud)) {
            Flash::error('Activo Solicitud no encontrado');

            return redirect(route('activoSolicitudes.index'));
        }

        $activoSolicitud->delete();

        Flash::success('Activo Solicitud deleted successfully.');

        return redirect(route('activoSolicitudes.index'));
    }

    public function activoSolicitudTemporal()
    {

        $user = auth()->user();

        $activoSolicitud = ActivoSolicitud::temporal()->delUsuarioCrea()->first();

        if (!$activoSolicitud) {
            $activoSolicitud = ActivoSolicitud::create([
                'estado_id' => ActivoSolicitudEstado::TEMPORAL,
                'usuario_autoriza' => auth()->user()->id,
            ]);
        }

        return $activoSolicitud;

    }

    public function getCodigo($cantidadCeros = 1)
    {
        return "AS-".prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = ActivoSolicitud::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

    public function anular(ActivoSolicitud $activoSolicitud)
    {

        try {
            DB::beginTransaction();

            $activoSolicitud->anular();

        } catch (\Exception $exception) {
            DB::rollBack();

            errorException($exception);

            return redirect()->back();
        }

        DB::commit();

        flash()->success('Listo! solicitud activos anulada.');

        return redirect(route('activoSolicitudes.index'));
    }

}
