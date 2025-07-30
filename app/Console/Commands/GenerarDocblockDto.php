<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ReflectionClass;

class GenerarDocblockDto extends Command
{
    protected $signature = 'dto:docblock {class : Ruta completa de la clase DTO (ej. App\\DTO\\ApiT24\\InformacionGeneralAsociado)}';

    protected $description = 'Genera un bloque PHPDoc con @property para facilitar el autocompletado en el IDE';

    public function handle()
    {
        $class = $this->argument('class');

        if (!class_exists($class)) {
            $this->error("❌ Clase '$class' no encontrada.");
            return 1;
        }

        $reflection = new ReflectionClass($class);
        $properties = $reflection->getProperties();

        $this->info("/**");

        foreach ($properties as $prop) {
            $this->line(" * @property string|null \${$prop->getName()}");
        }

        $this->info(" */");

        return 0;
    }
}
