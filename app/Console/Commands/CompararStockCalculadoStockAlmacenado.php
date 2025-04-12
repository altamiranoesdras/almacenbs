<?php

namespace App\Console\Commands;

use App\Models\CompraDetalle;
use App\Models\CompraEstado;
use App\Models\Item;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class CompararStockCalculadoStockAlmacenado extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compara:stock_calculado';

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
     * itera todos los items y muestra una tabla con in, codigo insumo,codigo presentación, nombre, stock segun kardex, stock principal
     *
     * @return int
     */
    public function handle()
    {

        $this->inicio();

        \DB::enableQueryLog();

        $queryInsumos = Item::with('stocks','kardexes')->whereHas('compraDetalles');



        //tabla filtros id, codigo insumo, codigo presentacion
        $resMenu = $this->choice("Seleccione un filtro para buscar insumos con diferencias", [
            '1' => 'Id',
            '2' => 'Multiples Ids',
            '3' => 'Codigo Insumo y Codigo Presentación',
            '4' => 'Todos'
        ]);

        $sinFiltros = false;


        switch ($resMenu) {
            case 'Id':
                $id = $this->ask("Ingrese el id del insumo");
                $queryInsumos->where('id',$id);
                break;
            case "Multiples Ids":
                $res = $this->ask("Ingrese los ids separados por coma");

                $ids = explode(',',$res);


                $queryInsumos->whereIn('id',$ids);

                break;
            case "Codigo Insumo y Codigo Presentación":
                $codigos = $this->ask("Ingrese el codigo de insumo y presentacion separados por coma");

                list($codigoInsumo,$codigoPresentacion) = explode(',',$codigos);

                $queryInsumos->where('codigo_insumo',$codigoInsumo);
                $queryInsumos->where('codigo_presentacion',$codigoPresentacion);

                break;
            case "Todos":
                $sinFiltros = true;
                break;
        }


        $insumos = $queryInsumos->get();

        if ($sinFiltros) {

            list($isumosConDiferencia,$conErrores) = $this->filtraInsumosCondifencia($insumos);
        }else{
            $isumosConDiferencia = $insumos;
            $conErrores = collect();
        }

        $this->dibujaTablaInsumos($isumosConDiferencia,$conErrores);

        if ($resMenu == 'Id' && $isumosConDiferencia->count() > 0){
            $this->dibujarIngresosEgresoInsumo($isumosConDiferencia->first());
        }

    }

    public function filtraInsumosCondifencia($insumos): array
    {
        $this->barraProcesoIniciar($insumos->count());

        $conErrores = collect();

        $isumosConDiferencia = $insumos->filter(function(Item $insumo) use ($conErrores){
            $this->barraProcesoAvanzar();

            try {
                return $insumo->getStockCalculado() != $insumo->stock_bodega;

            }catch (\Exception $e) {
                $conErrores->push($insumo);
                return false;
            }
        });

        $this->barraProcesoFin();


        return [$isumosConDiferencia,$conErrores];

    }

    public function dibujaTablaInsumos($insumos,$conErrores)
    {

        $this->info("Insumos con diferencias: ".$insumos->count());

        $this->table(['id','nombre','Stock Bodega','Stock Según Kardex'], $insumos->map(function(Item $insumo){
            return [
                $insumo->id,
                $insumo->text,
                $insumo->stock_bodega,
                $insumo->getStockCalculado(),
            ];
        }));

        if ($conErrores->count() > 0) {
            $this->info("Con errores: ".$conErrores->count());
            $this->table(['id','nombre','stock_kardex','stock_principal'], $conErrores->map(function(Item $insumo){
                return [
                    'id' => $insumo->id,
                    'nombre' => $insumo->text,
                ];
            }));
        }


    }

    public function dibujarIngresosEgresoInsumo(Item $insumo)
    {

        $this->line("");

        $this->line("Entradas: ");

        $detalles = $insumo->compraDetalles()->whereHas('compra',function($query){
            $query->where('estado_id',CompraEstado::RECIBIDA);
        })->get();

        $this->table(['id','codigo','fecha','cantidad','precio'], $detalles->map(function(CompraDetalle $detalle){
            return [
               $detalle->compra_id,
               $detalle->compra->compra1h->folio,
                fechaLtn($detalle->compra->fecha_ingreso),
               $detalle->cantidad,
               $detalle->precio
            ];
        }));

        $this->line("Salidas: ");

        $detalles = $insumo->solicitudDetalles()->whereHas('solicitud',function($query){
            $query->where('estado_id',"!=",SolicitudEstado::ANULADA);
        })->get();

        $this->table(['id','fecha','codigo','Cantidad Sol','Cantidad Desp','precio'], $detalles->map(function(SolicitudDetalle $detalle){
            return [
               $detalle->solicitud_id,
                fechaLtn($detalle->solicitud->fecha_despacha),
                $detalle->solicitud->codigo,
               $detalle->cantidad_solicitada,
               $detalle->cantidad_despachada,
               $detalle->precio
            ];
        }));

        $this->line("Totales");

        $this->table(['Stock Inicia','Entradas','Salidas'],[[
            $insumo->getStockInicial(),
            $insumo->getEntradasStock(),
            $insumo->getSalidasStock()
        ]]);


    }
}
