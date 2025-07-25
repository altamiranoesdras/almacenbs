<?php

namespace App\Console\Commands;

use App\Models\Proveedor;
use Illuminate\Console\Command;
use League\Csv\Reader;

class LeerProveedoresCSV extends Command
{
    protected $signature = 'leer:proveedores';
    protected $description = 'Lee e itera el archivo Proveedores 2.csv con league/csv';

    public function handle()
    {
        $path = storage_path('temp/proveedores.csv');

        if (!file_exists($path)) {
            $this->error("El archivo no existe en: $path");
            return;
        }

        $this->line("Leyendo el archivo CSV: $path");

        $csv = Reader::createFromPath($path, 'r');
        $csv->setDelimiter('|'); // Asegúrate de que el delimitador sea correcto

        $csv->setHeaderOffset(0); // Primera fila como encabezado

        deshabilitaLlavesForaneas();

        //truncate the Proveedores table before inserting new records
        Proveedor::truncate();

        foreach ($csv->getRecords() as $record) {

            Proveedor::create(
                [
                    'nit' => $record['nit'],
                    'nombre' => $record['nombre'],
                    'razon_social' => $record['nombre'],
                    'correo' => $record['correo'] ?? null,
                    'telefono_movil' => $record['telefono_movil'] ?? null,
                    'telefono_oficina' => $record['telefono_oficina'] ?? null,
                    'direccion' => $record['direccion'] ?? null,
                    'observaciones' => $record['observaciones'] ?? '',
                ]
            );

        }
    }
}
