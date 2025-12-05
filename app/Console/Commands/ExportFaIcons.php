<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportFaIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export-fa-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cssPath = public_path('assets/fontawesome/css/all.css'); // ajusta la ruta
        $css = file_get_contents($cssPath);

        preg_match_all('/\.fa-([a-z0-9-]+):before\s*{/', $css, $matches);
        $icons = array_unique($matches[1]);

        $data = [];
        foreach ($icons as $icon) {
            $data[] = [
                'id'    => $icon,
                'label' => str_replace('-', ' ', $icon),
            ];
        }

        $jsonPath = storage_path('app/fa-icons.json');
        file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info('Íconos exportados: ' . count($data));
        $this->info('Archivo: ' . $jsonPath);
    }
}
