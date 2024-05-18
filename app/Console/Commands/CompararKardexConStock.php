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
        $this->table(['No.','filtro'], [
            ['1','id'],
            ['2','codigo insumo y presentacion'],
            ['3','sin filtro']
        ]);

        $res = $this->ask("Seleccione un filtro para buscar insumos con diferencias");


        switch ($res) {
            case '1':
                $id = $this->ask("Ingrese el id del insumo");
                $queryInsumos->where('id',$id);
                break;
            case '2':
                $codigoInsumo = $this->ask("Ingrese el codigo del insumo");

                $codigoPresentacion = $this->ask("Ingrese el codigo de la presentacion");
                $queryInsumos->where('codigo_insumo',$codigoInsumo);
                $queryInsumos->where('codigo_presentacion',$codigoPresentacion);

                break;
            case '3':
                break;
        }


        $insumos = $queryInsumos->get();


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

        $this->info("Insumos con diferencias: ".$isumosConDiferencia->count());

        $this->table(['id','nombre','stock_kardex','stock_principal'], $isumosConDiferencia->map(function(Item $insumo){
            return [
                'id' => $insumo->id,
                'nombre' => $insumo->text,
                'stock_kardex' => $insumo->getStockCalculado(),
                'stock_principal' => $insumo->stock_bodega
            ];
        }));

        $this->info("Con errores: ".$conErrores->count());
        $this->table(['id','nombre','stock_kardex','stock_principal'], $conErrores->map(function(Item $insumo){
            return [
                'id' => $insumo->id,
                'nombre' => $insumo->text,
            ];
        }));

    }
}
