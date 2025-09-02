<?php

namespace App\Console\Commands\Archivados;

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
        $ultimoRegistro = Kardex::without('model')->where('item_id', $id)->orderBy('folio', 'desc')->first();

        if(!$ultimoRegistro){
            $this->error('No se encontraron registros para el insumo con id: ' . $id);
            return 0;
        }

        $folioActual = $ultimoRegistro->folio;

        $this->line('Ultimo registro del folio ' . $folioActual);

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

        $siguienteFolio = $ultimoRegistro->siguienteFolio();

        //informa cual es el siguiente folio
        $this->line('El siguiente folio a crear es: ' . $siguienteFolio);

        if ($siguienteFolio == $folioActual) {
            $this->error('El siguiente folio es igual al folio actual');
            //pregunta si se desea forzar la creación del folio
            $forzar = $this->askWithCompletion('¿Desea forzar la creación del folio?', ['si', 'no'], 'no');
            if($forzar=='no'){
                $this->warn('No se creó el folio');
            }else{
                $siguienteFolio = $ultimoRegistro->siguienteFolio(true);
                $this->line('El siguiente folio a crear es: ' . $siguienteFolio);
            }
        }

        //confirmar si se crea el nuevo folio
        $confirma = $this->askWithCompletion('¿Escriba "si" para confirmar la creación del folio?', ['si', 'no'], 'no');

        if($confirma=='no'){
            $this->warn('No se creó el folio');
            return 0;
        }


        $ultimoRegistro->folio = $siguienteFolio;
        $ultimoRegistro->save();
        $this->info('Folio actualizado correctamente');

    }
}
