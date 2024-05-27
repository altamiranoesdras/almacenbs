<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class CompararKardexConStock extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comparar:kardex-stock';

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
        $res = $this->choice("Seleccione un filtro para buscar insumos con diferencias", [
            '1' => 'Id',
            '2' => 'Multiples Ids',
            '3' => 'Codigo Insumo y Codigo Presentación',
            '4' => 'Todos'
        ]);

        $sinFiltros = false;


        switch ($res) {
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
                $codigoInsumo = $this->ask("Ingrese el codigo del insumo");

                $codigoPresentacion = $this->ask("Ingrese el codigo de la presentacion");
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
}
