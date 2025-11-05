<?php

namespace App\Console\Commands;

use App\Models\Solicitud;
use App\Models\SolicitudEstado;
use App\Traits\ComandosTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LlenarFoliosRequisicionesAlmacen extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:llenar-folios-requisiciones-almacen';

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
        $this->inicio();

        $conteoPorEstado = Solicitud::all()
            ->groupBy('estado.nombre')
            ->map(function ($group) {
                return $group->count();
            });

        $this->table(
            ['Estado', 'Cantidad'],
            $conteoPorEstado->map(function ($count, $estado) {
                return [$estado, $count];
            })->toArray()
        );

        $todasLasSolicitudes = Solicitud::query()
            ->where('estado_id', '!=', SolicitudEstado::TEMPORAL)
            ->whereNotNull('justificacion')
//            ->whereId(5)
            ->get();

        $this->line("Inicio de extracción de folios y fecha de la justificación de las solicitudes de requisiciones de almacén.");

        foreach ($todasLasSolicitudes as $solicitud) {
            $justificacion = $solicitud->justificacion;

            list($folio, $fechaCarbon) = $this->extraerFolioYFecha($justificacion);


            if (!$folio || !$fechaCarbon) {
                if (!$folio) {
                    $this->warn("No se encontró folio en la solicitud ID {$solicitud->id}.");
                }
                if (!$fechaCarbon) {
                    $this->warn("No se encontró fecha en la solicitud ID {$solicitud->id}.");
                }
                continue; // Si no hay folio o fecha, saltar a la siguiente solicitud
            }

            $solicitud->folio = $folio;
            $solicitud->fecha_solicita = $fechaCarbon;
            $solicitud->fecha_autoriza = $fechaCarbon;
            $solicitud->fecha_despacha = $fechaCarbon;
            $solicitud->save();

            foreach ($solicitud->detalles as $detalle) {
                $detalle->kardex()->update(['created_at' => $fechaCarbon,]);
            }

        }

        $this->fin();

    }

    /**
     * Extrae folio (número de 4–10 dígitos) y fecha desde un texto libre.
     * - Acepta fechas en formatos: dd/mm/yyyy, dd-mm-yyyy, dd.mm.yyyy.
     * - También corrige casos sin separador día-mes: p.ej. "2210/2023" -> 22/10/2023.
     * - Prioriza el folio más cercano ANTES de la fecha (ventana de 40 caracteres).
     * - Si no hay fecha pero sí folio, devuelve la fecha como null.
     * - Si no hay folio pero sí fecha, devuelve el folio como null.
     * - Si no encuentra nada, devuelve null.
     *
     * @param string $texto
     * @return array{0:?string,1:?Carbon\Carbon}|null [folio, fechaCarbon]
     */
    private function extraerFolioYFecha(string $texto): ?array
    {
        $texto = trim($texto);

        // --- 1) Buscar FECHA ---
        // 1.a) Formatos con separadores entre día, mes y año
        $patFechaSeparadores = '/(?P<d>(?:0?[1-9]|[12]\d|3[01]))[\/\-.](?P<m>(?:0?[1-9]|1[0-2]))[\/\-.](?P<y>(?:19|20)\d{2})/u';

        // 1.b) Caso "pegado" día-mes, con separador solo antes del año (ej: 2210/2023 -> 22/10/2023)
        $patFechaPegada = '/(?P<d2>(?:0?[1-9]|[12]\d|3[01]))(?P<m2>(?:0?[1-9]|1[0-2]))[\/\-.](?P<y2>(?:19|20)\d{2})/u';

        $fechaCarbon = null;
        $posFecha = null;

        if (preg_match($patFechaSeparadores, $texto, $m1, PREG_OFFSET_CAPTURE)) {
            [$d, $m, $y] = [$m1['d'][0], $m1['m'][0], $m1['y'][0]];
            $posFecha = $m1[0][1];
            $fechaStr = sprintf('%02d/%02d/%04d', (int)$d, (int)$m, (int)$y);
            try {
                $fechaCarbon = \Carbon\Carbon::createFromFormat('d/m/Y', $fechaStr);
            } catch (\Throwable $e) {
                $fechaCarbon = null;
            }
        } elseif (preg_match($patFechaPegada, $texto, $m2, PREG_OFFSET_CAPTURE)) {
            [$d, $m, $y] = [$m2['d2'][0], $m2['m2'][0], $m2['y2'][0]];
            $posFecha = $m2[0][1];
            $fechaStr = sprintf('%02d/%02d/%04d', (int)$d, (int)$m, (int)$y);
            try {
                $fechaCarbon = \Carbon\Carbon::createFromFormat('d/m/Y', $fechaStr);
            } catch (\Throwable $e) {
                $fechaCarbon = null;
            }
        }

        // --- 2) Buscar FOLIO (número 4–10 dígitos) ---
        $patFolio = '/(?<!\d)(?P<folio>\d{4,10})(?!\d)/u';
        $folio = null;

        if ($fechaCarbon !== null && $posFecha !== null) {
            // Ventana de 40 caracteres ANTES de la fecha para priorizar folio cercano
            $ventanaTam = 40;
            $inicioVentana = max(0, $posFecha - $ventanaTam);
            $ventana = mb_substr($texto, $inicioVentana, $ventanaTam);

            if (preg_match($patFolio, $ventana, $mFolioCercano)) {
                $folio = $mFolioCercano['folio'];
            }
        }

        // Si no se halló folio cercano, tomar el primer 4–10 dígitos en todo el texto
        if ($folio === null && preg_match($patFolio, $texto, $mFolioPrimero)) {
            $folio = $mFolioPrimero['folio'];
        }

        // Si no hay ni folio ni fecha, no hay nada útil
        if ($folio === null && $fechaCarbon === null) {
            return null;
        }

        return [$folio, $fechaCarbon];
    }
}
