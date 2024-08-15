<?php

namespace App\Console\Commands;

use App\Models\Kardex;
use Illuminate\Console\Command;

class CrearFolioUltimoRegistroKardex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kardex:crear_folio_ultimo_registro';

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
        //preguntar por el id del insumo que se desea actualizar
        $id = $this->ask('Ingrese el id del insumo que desea actualizar');

        /**
         * @var Kardex $ultimoRegistro
         */
        $ultimoRegistro = Kardex::without('model')->where('item_id', $id)->orderBy('id', 'desc')->first();

        if(!$ultimoRegistro){
            $this->error('No se encontraron registros para el insumo con id: ' . $id);
            return 0;
        }

        //dibuja la tabla con los registros
        $this->table([
            'id',
            'tipo',
            'codigo',
            'responsable',
            'cantidad',
            'precio_movimiento',
            'folio',
            'saldo',
        ], [
            [
                $ultimoRegistro->id,
                $ultimoRegistro->tipo,
                $ultimoRegistro->codigo,
                $ultimoRegistro->responsable,
                $ultimoRegistro->cantidad,
                $ultimoRegistro->precio_movimiento,
                $ultimoRegistro->folio,
                $ultimoRegistro->saldo,
            ]
        ]);


        //informa cual es el siguiente folio
        $this->line("-----------------------------------");
        $this->line('El siguiente folio es: ' . $ultimoRegistro->siguienteFolio());
        $this->line("-----------------------------------");

        //confirmar si se crea el nuevo folio
        if($this->confirm('¿Desea crear un nuevo folio para el registro anterior?')){
            $ultimoRegistro->folio = $ultimoRegistro->siguienteFolio();
            $ultimoRegistro->save();
            $this->info('Folio actualizado correctamente');
        }

    }
}
