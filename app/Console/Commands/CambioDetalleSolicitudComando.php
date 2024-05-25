<?php

namespace App\Console\Commands;

use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CambioDetalleSolicitudComando extends Command
{

    use ComandosTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solicitudes:cambio_detalle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $codigo = $this->ask("Ingrese el código de la solicitud");

        $solicitud = \App\Models\Solicitud::where('codigo', $codigo)->first();

        if (!$solicitud) {
            $this->error("No se encontró la solicitud con el código: $codigo");
            return 0;
        }

        $this->info("Solicitud encontrada: $solicitud->codigo");

        //detalles de la solicitud
        $this->dibujaDetalles($solicitud,null);

        //solicitar id detalle a cambiar
        $idDetalle = $this->ask("Ingrese el id del detalle a cambiar");


        $this->dibujaDetalles($solicitud,$idDetalle);

        $detalleCambiar = $solicitud->detalles->where('id',$idDetalle)->first();


        $idNuevoInsumo = $this->ask("Ingrese el id del nuevo insumo");
        $nuevaCantidad = $this->ask("Ingrese la nueva cantidad");
        $nuevoInsumo = \App\Models\Item::find($idNuevoInsumo);


        $this->table(["Insumo Origen","Cantidad Despachada","Insumo Nuevo","Nueva Cantidad"],[[
            $detalleCambiar->item->text,
            $detalleCambiar->cantidad_despachada,
            $nuevoInsumo->text,
            $nuevaCantidad
        ]]);



        try {
            DB::beginTransaction();

            $detalleCambiar->anular();

            $detalleCambiar->cantidad_solicitada = $nuevaCantidad;
            $detalleCambiar->cantidad_aprobada = $nuevaCantidad;
            $detalleCambiar->cantidad_despachada = $nuevaCantidad;
            $detalleCambiar->item_id = $nuevoInsumo->id;
            $detalleCambiar->save();

            $detalleCambiar->egreso();

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();

        return 0;
    }


    public function dibujaDetalles(Solicitud $solicitud,$idDetalle)
    {

        $detalles = $solicitud->detalles->filter(function (SolicitudDetalle $detalle) use ($idDetalle) {
            if ($idDetalle){
                return $detalle->id == $idDetalle;
            }
            return $detalle;
        });

        $detalles = $detalles->map(function (SolicitudDetalle $detalle) {

            return [
                $detalle->id,
                $detalle->item->text,
                $detalle->cantidad_solicitada,
                $detalle->cantidad_aprobada,
                $detalle->cantidad_despachada,
            ];
        });

        $this->table(['Id', 'insumo','Cantidad Sol','Cantidad Apro','Cantidad Desp'], $detalles->toArray() );

    }
}
