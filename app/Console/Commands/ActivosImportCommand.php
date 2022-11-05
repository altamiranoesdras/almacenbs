<?php

namespace App\Console\Commands;

use App\Imports\ActivosImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

class ActivosImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:activos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command importar activos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->output->title('Iniciando Importación');

        try {
            DB::beginTransaction();

            $import = new ActivosImport();

            $import->withOutput($this->output)->import(public_path('imports/activos/plantilla_import_activos.xlsx'));

        }
        catch (ValidationException $e) {

            DB::rollBack();
            $erros = array();
            foreach ($e->failures() as $failure) {
                $erros[] = "Error en fila ".$failure->row().": ".implode($failure->errors());
            }

            \Log::debug($erros);

        }
        catch (Exception $e){

            \Log::debug($e);
            DB::rollBack();

            throw $e;

        }
        DB::commit();

        $this->output->success('Importación Exitosa!');

    }

}
