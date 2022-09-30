<?php

namespace App\Http\Controllers;

use App\DataTables\ActivoTarjetaDataTable;
use App\DataTables\Scopes\ScopeActivoTarjetaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateActivoTarjetaRequest;
use App\Http\Requests\UpdateActivoTarjetaRequest;
use App\Models\ActivoTarjeta;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\App;
use Response;

class ActivoTarjetaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Activo Tarjetas')->only(['show']);
        $this->middleware('permission:Crear Activo Tarjetas')->only(['create','store']);
        $this->middleware('permission:Editar Activo Tarjetas')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Activo Tarjetas')->only(['destroy']);
    }

    /**
     * Display a listing of the ActivoTarjeta.
     *
     * @param ActivoTarjetaDataTable $activoTarjetaDataTable
     * @return Response
     */
    public function index(ActivoTarjetaDataTable $activoTarjetaDataTable)
    {

        $scope = new ScopeActivoTarjetaDataTable();

        $activoTarjetaDataTable->addScope($scope);

        return $activoTarjetaDataTable->render('activo_tarjetas.index');
    }

    /**
     * Show the form for creating a new ActivoTarjeta.
     *
     * @return Response
     */
    public function create()
    {
        return view('activo_tarjetas.create');
    }

    /**
     * Store a newly created ActivoTarjeta in storage.
     *
     * @param CreateActivoTarjetaRequest $request
     *
     * @return Response
     */
    public function store(CreateActivoTarjetaRequest $request)
    {
        $input = $request->all();

        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::create($input);

        Flash::success('Activo Tarjeta guardado exitosamente.');

        return redirect(route('activoTarjetas.edit', $activoTarjeta->id));
    }

    /**
     * Display the specified ActivoTarjeta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        return view('activo_tarjetas.show')->with('activoTarjeta', $activoTarjeta);
    }

    /**
     * Show the form for editing the specified ActivoTarjeta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        return view('activo_tarjetas.edit')->with('activoTarjeta', $activoTarjeta);
    }

    /**
     * Update the specified ActivoTarjeta in storage.
     *
     * @param  int              $id
     * @param UpdateActivoTarjetaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivoTarjetaRequest $request)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        $activoTarjeta->fill($request->all());
        $activoTarjeta->save();

        Flash::success('Activo Tarjeta actualizado con éxito.');

        return redirect(route('activoTarjetas.index'));
    }

    /**
     * Remove the specified ActivoTarjeta from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ActivoTarjeta $activoTarjeta */
        $activoTarjeta = ActivoTarjeta::find($id);

        if (empty($activoTarjeta)) {
            Flash::error('Activo Tarjeta no encontrado');

            return redirect(route('activoTarjetas.index'));
        }

        $activoTarjeta->delete();

        Flash::success('Activo Tarjeta deleted successfully.');

        return redirect(route('activoTarjetas.index'));
    }

    public function pdf(ActivoTarjeta $activoTarjeta)
    {

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('activo_tarjetas.tarjeta_responsabilidad_pdf', compact('activoTarjeta'))->render();

        $pdf->loadHTML($view)
//            ->setOption('page-width', '220')
//            ->setOption('page-height', '280')
            ->setOrientation('landscape')
            // ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 10)
            ->setOption('margin-bottom',3)
            ->setOption('margin-left',10)
            ->setOption('margin-right',10);
            // ->stream('report.pdf');

        foreach ($activoTarjeta->detalles as $detalle) {
            if (!$detalle->impreso) {
                $detalle->impreso = 1;
                $detalle->save();
            }
        }

        return $pdf->inline('TarjetaResponsabilidad '.$activoTarjeta->id. '_'. time().'.pdf');

    }

}
