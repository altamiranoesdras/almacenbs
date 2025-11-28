<?php

namespace App\Models\CompraRequisicion;

use App\FirmaElectronica\FirmaElectronica;
use App\Models\Bitacora;
use App\Models\CompraRequisicionDetalle;
use App\Models\CompraRequisicionEstado;
use App\Models\CompraRequisicionTipoConcurso;
use App\Models\CompraSolicitud;
use App\Models\Proveedor;
use App\Models\RrhhUnidad;
use App\Models\User;
use App\Traits\HasBitacora;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

/**
 * @property int $id
 * @property int|null $tipo_concurso_id
 * @property int|null $tipo_adquisicion_id
 * @property int|null $correlativo
 * @property string|null $codigo ID interno de gestión, p.ej. G-2025-001
 * @property string|null $codigo_consolidacion Código de lote interno, p.ej. L-2025-001
 * @property string|null $npg Número de Publicación (Compra Menor)
 * @property string|null $nog Número de Operación (Licitación Abreviada)
 * @property int $usuario_crea_id
 * @property int|null $usuario_aprueba_id
 * @property int|null $usuario_autoriza_id
 * @property int|null $usuario_asigna_id
 * @property int|null $usuario_analista_id
 * @property int $unidad_id
 * @property int|null $proveedor_adjudicado
 * @property string|null $numero_adjudicacion
 * @property int $estado_id
 * @property string|null $subproductos
 * @property string|null $partidas
 * @property string|null $observaciones
 * @property string|null $justificacion
 * @property Carbon|null $fecha_solicita
 * @property Carbon|null $fecha_aprueba
 * @property int|null $usuario_solicita_id
 * @property Carbon|null $fecha_autoriza
 * @property bool|null $tiene_firma_solicitante
 * @property bool|null $tiene_firma_aprobador
 * @property bool|null $tiene_firma_autorizador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read Collection<int, CompraSolicitud> $compraSolicitudes
 * @property-read int|null $compra_solicitudes_count
 * @property-read Collection<int, CompraRequisicionDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read CompraRequisicionEstado $estado
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read Proveedor|null $proveedorAdjudicado
 * @property-read CompraRequisicionTipoConcurso|null $tipoConcurso
 * @property-read RrhhUnidad $unidad
 * @method static \Database\Factories\CompraRequisicion\CompraRequisicionFactory factory($count = null, $state = [])
 * @method static Builder|CompraRequisicion newModelQuery()
 * @method static Builder|CompraRequisicion newQuery()
 * @method static Builder|CompraRequisicion onlyTrashed()
 * @method static Builder|CompraRequisicion query()
 * @method static Builder|CompraRequisicion whereCodigo($value)
 * @method static Builder|CompraRequisicion whereCodigoConsolidacion($value)
 * @method static Builder|CompraRequisicion whereCorrelativo($value)
 * @method static Builder|CompraRequisicion whereCreatedAt($value)
 * @method static Builder|CompraRequisicion whereDeletedAt($value)
 * @method static Builder|CompraRequisicion whereEstadoId($value)
 * @method static Builder|CompraRequisicion whereFechaAprueba($value)
 * @method static Builder|CompraRequisicion whereFechaAutoriza($value)
 * @method static Builder|CompraRequisicion whereFechaSolicita($value)
 * @method static Builder|CompraRequisicion whereId($value)
 * @method static Builder|CompraRequisicion whereJustificacion($value)
 * @method static Builder|CompraRequisicion whereNog($value)
 * @method static Builder|CompraRequisicion whereNpg($value)
 * @method static Builder|CompraRequisicion whereNumeroAdjudicacion($value)
 * @method static Builder|CompraRequisicion whereObservaciones($value)
 * @method static Builder|CompraRequisicion wherePartidas($value)
 * @method static Builder|CompraRequisicion whereProveedorAdjudicado($value)
 * @method static Builder|CompraRequisicion whereSubproductos($value)
 * @method static Builder|CompraRequisicion whereTieneFirmaAprobador($value)
 * @method static Builder|CompraRequisicion whereTieneFirmaAutorizador($value)
 * @method static Builder|CompraRequisicion whereTieneFirmaSolicitante($value)
 * @method static Builder|CompraRequisicion whereTipoAdquisicionId($value)
 * @method static Builder|CompraRequisicion whereTipoConcursoId($value)
 * @method static Builder|CompraRequisicion whereUnidadId($value)
 * @method static Builder|CompraRequisicion whereUpdatedAt($value)
 * @method static Builder|CompraRequisicion whereUsuarioAnalistaId($value)
 * @method static Builder|CompraRequisicion whereUsuarioApruebaId($value)
 * @method static Builder|CompraRequisicion whereUsuarioAsignaId($value)
 * @method static Builder|CompraRequisicion whereUsuarioAutorizaId($value)
 * @method static Builder|CompraRequisicion whereUsuarioCreaId($value)
 * @method static Builder|CompraRequisicion whereUsuarioSolicitaId($value)
 * @method static Builder|CompraRequisicion withTrashed()
 * @method static Builder|CompraRequisicion withoutTrashed()
 * @mixin Eloquent
 */
class CompraRequisicion extends Model implements HasMedia
{

    use SoftDeletes;
    use HasFactory;
    use HasBitacora;
    use InteractsWithMedia;

    public $table = 'compra_requisiciones';

    public $fillable = [
        'tipo_concurso_id',
        'tipo_proceso_id',
        'tipo_adquisicion_id',
        'numero_orden_compra',
        'correlativo',
        'codigo',
        'codigo_consolidacion',
        'npg',
        'nog',
        'usuario_crea_id',
        'usuario_solicita_id',
        'usuario_aprueba_id',
        'usuario_autoriza_id',
        'usuario_asigna_id',
        'usuario_analista_id',
        'unidad_id',
        'proveedor_adjudicado',
        'numero_adjudicacion',
        'estado_id',
        'subproductos',
        'partidas',
        'observaciones',
        'justificacion',
        'fecha_solicita',
        'fecha_aprueba',
        'fecha_autoriza',
        'tiene_firma_solicitante',
        'tiene_firma_aprobador',
        'tiene_firma_autorizador',
    ];

    protected $casts = [
        'codigo' => 'string',
        'codigo_consolidacion' => 'string',
        'npg' => 'string',
        'nog' => 'string',
        'numero_adjudicacion' => 'string',
        'subproductos' => 'string',
        'partidas' => 'string',
        'observaciones' => 'string',
        'justificacion' => 'string',
        'fecha_solicita' => 'date',
        'fecha_aprueba' => 'date',
        'fecha_autoriza' => 'date',
        'tiene_firma_solicitante' => 'boolean',
        'tiene_firma_aprobador' => 'boolean',
        'tiene_firma_autorizador' => 'boolean',
    ];

    public static array $rules = [
        'tipo_concurso_id' => 'nullable',
        'tipo_adquisicion_id' => 'nullable',
        'correlativo' => 'nullable',
        'codigo' => 'nullable|string|max:20',
        'codigo_consolidacion' => 'nullable|string|max:45',
        'npg' => 'nullable|string|max:45',
        'nog' => 'nullable|string|max:45',
        'proveedor_adjudicado' => 'nullable',
        'numero_adjudicacion' => 'nullable|string|max:45',
        'estado_id' => 'nullable',
        'subproductos' => 'nullable|string|max:45',
        'partidas' => 'nullable|string|max:45',
        'observaciones' => 'nullable|string|max:65535',
        'justificacion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'fecha_solicita' => 'nullable|date',
        'fecha_aprueba' => 'nullable|date',
        'fecha_autoriza' => 'nullable|date',
        'tiene_firma_solicitante' => 'nullable|boolean',
        'tiene_firma_aprobador' => 'nullable|boolean',
        'tiene_firma_autorizador' => 'nullable|boolean',
    ];

    public static array $messages = [

    ];

    const COLLECTION_REQUISICION_COMPRA = 'requisicion_compra';

    protected static function booted(): void
    {
        /**
         * Genera el código de la requisición al momento de crearla.
         * @var CompraRequisicion $requisicion
         *
         */
        static::created(function ($requisicion) {
            $year = now()->year;
            $numero = str_pad($requisicion->id, 3, '0', STR_PAD_LEFT);
            $requisicion->codigo = "G-$year-$numero";
            $requisicion->codigo_consolidacion = "L-$year-$numero";
            $requisicion->save();
        });
    }

    public function tipoConcurso(): BelongsTo
    {
        return $this->belongsTo(CompraRequisicionTipoConcurso::class, 'tipo_concurso_id');
    }

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(RrhhUnidad::class, 'unidad_id');
    }

    public function proveedorAdjudicado(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_adjudicado');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(CompraRequisicionEstado::class, 'estado_id');
    }

//    public function compraOrdenes(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(\App\Models\CompraOrdene::class, 'gestion_id');
//    }

    public function detalles(): HasMany
    {
        return $this->hasMany(CompraRequisicionDetalle::class, 'requisicion_id');
    }

//    public function compraSolicitudes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(\App\Models\CompraSolicitude::class, 'compra_solicitud_has_requisicion');
//    }

    public function compraSolicitudes(): BelongsToMany
    {
        return $this->belongsToMany(
            CompraSolicitud::class,
            'compra_solicitud_has_requisicion',
            'requisicion_id',
            'solicitud_id'
        );

    }

    public function solicitar(): void
    {
        $this->estado_id = CompraRequisicionEstado::REQUERIDA;
        $this->fecha_solicita = now();
        $this->usuario_solicita_id = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA SOLICITADA");
    }

    public function aprobar(): void
    {
        $this->estado_id = CompraRequisicionEstado::APROBADA;
        $this->fecha_aprueba = now();
        $this->usuario_aprueba_id = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA APROBADA");
    }

    public function autorizar(): void
    {
        $this->estado_id = CompraRequisicionEstado::AUTORIZADA;
        $this->fecha_autoriza = now();
        $this->usuario_autoriza_id = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA AUTORIZADA");
    }

    public function puedeSolicitarse(): bool
    {
        return $this->estado_id == CompraRequisicionEstado::CREADA && $this->tiene_firma_solicitante;
    }

    public function puedeAprobarse(): bool
    {
        return $this->estado_id == CompraRequisicionEstado::REQUERIDA && $this->tiene_firma_aprobador;
    }

    public function puedeAutorizarse(): bool
    {
        return in_array($this->estado_id,[
            CompraRequisicionEstado::APROBADA,
            CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_AUTORIZADOR,
        ]) && $this->tiene_firma_autorizador;
    }

    //TODO: Esta función debe de completarse.
    public function puedeAprobarSupervisor(): bool
    {
        return $this->estado_id == CompraRequisicionEstado::AUTORIZADA || $this->estado_id == CompraRequisicionEstado::ASIGNACION_REQUISICIONES;
    }

    //TODO: Esta función debe de completarse.

    /**
     * @param $comentario
     * @param  int  $usuario_analista_id
     * @return void
     */
    public function supervisorVistoBueno($comentario = null, int $usuario_analista_id = null): void
    {
        $comentario = $comentario ?? '';

        if ($this->estado_id == CompraRequisicionEstado::AUTORIZADA ||
            $this->estado_id == CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR)
        {
            $this->estado_id = CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS;
        } else {
            $this->estado_id = CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS;
            $this->usuario_analista_id = $usuario_analista_id;
            $this->usuario_asigna_id = usuarioAutenticado()->id;
        }

        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA APROBADA POR SUPERVISOR", $comentario);
    }

    public function supervisorRetornar($comentario = ''): void
    {
        if ($this->estado_id == CompraRequisicionEstado::AUTORIZADA) {
            $this->estado_id = CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_AUTORIZADOR;
        } else {
            $this->estado_id = CompraRequisicionEstado::RETORNADA_POR_SUPERVISOR_A_ANALISTA_DE_PRESUPUESTO;
        }

        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA RETORNADA POR SUPERVISOR", $comentario);

    }

    public function analistaPresupuestoVistoBueno($comentario = ''): void
    {
        $this->estado_id = CompraRequisicionEstado::ASIGNACION_REQUISICIONES;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA APROBADA POR ANALISTA DE PRESUPUESTO", $comentario ?? '');

    }

    public function analistaPresupuestoRetorna($comentario=''): void
    {
        $this->estado_id = CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA RETORNADA POR ANALISTA DE PRESUPUESTO", $comentario);
    }

    public function analistaComprasProcesar($datos, $comentario=''): void
    {

        if($this->estado_id == CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS) {
            $this->update([
                'tipo_proceso_id' => $datos->tipo_proceso_id,
                'tipo_adquisicion_id' => $datos->tipo_adquisicion_id,
                'npg' => $datos->numero_npg,
                'nog' => $datos->numero_nog,
                'tipo_concurso_id' => $datos->concurso_id,
                'proveedor_adjudicado' => $datos->proveedor_id,
                'numero_adjudicacion' => $datos->numero_adjudicacion,
                'estado_id' => CompraRequisicionEstado::INICIO_DE_GESTION,
            ]);
        }else if ($this->estado_id == CompraRequisicionEstado::INICIO_DE_GESTION) {
            $this->update([
                'numero_orden_compra' => $datos->numero_orden_compra,
                'estado_id' => CompraRequisicionEstado::ORDEN_DE_COMPRA_GENERADA,
            ]);
            $this->addMedia($datos->orden_compra)
                ->toMediaCollection('Orden de Compra');
        }

        $this->addBitacora("REQUISICIÓN DE COMPRA PROCESADA POR ANALISTA DE COMPRAS", $comentario);

    }

    public function getLastMediaUrl(string $collection = 'default', string $conversion = ''): ?string
    {
        return $this->getMedia($collection)
            ->sortByDesc('created_at')
            ->first()?->getUrl($conversion);

    }

    public function puedeEditar(): bool
    {
        return $this->estado_id == CompraRequisicionEstado::CREADA;
    }

    public function puedeAnular(): bool
    {
        return $this->estado_id != CompraRequisicionEstado::CANCELADA;
    }

    /**
     * @throws Throwable
     */
    public function generarPdfUpload(): UploadedFile
    {
        // 1) Generar el PDF con Snappy (wkhtmltopdf)
        $pdf = App::make('snappy.pdf.wrapper');

        $requisicion = $this;

        $view = view('compra_requisiciones.pdfs.requisicion_pdf', compact('requisicion'))->render();

        $pdf->loadHTML($view)
            ->setOption('page-width', 279)   // mm
            ->setOption('page-height', 216)  // mm
            ->setOrientation('landscape')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 15);

        // 2) Guardar el PDF en storage/app/public/firmas/pdfs
        $disk = 'public';
        $folderPdf = 'requisiciones/generadas';              // carpeta para PDF generados (previos a la firma)
        $filename = 'Requisicion_' . $this->id . '_' . time() . '.pdf';
        $relativePdfPath = $folderPdf . '/' . $filename;

        $binary = $pdf->output();
        Storage::disk($disk)->put($relativePdfPath, $binary);

        // 3) Envolver el archivo como UploadedFile para pasarlo al firmador
        $absolutePdfPath = Storage::disk($disk)->path($relativePdfPath);
        return new UploadedFile(
            $absolutePdfPath,
            $filename,
            'application/pdf',
            null,
            true // test mode (no mueve/elimina el archivo fuente)
        );
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function firmar(User $usuario, string $contrasenaFirma, UploadedFile $uploaded): Media
    {
        $x = 0;
        $y = 280;

        foreach ($this->detalles as $index => $detalle) {
            if($index > 15) {
                $y -= 13;
            }
        }

        // 4) Firmar usando tu mismo builder
        $rutaArchivoFirmado = (new FirmaElectronica())
            ->respuestaRuta()
            ->setDisco('public')                                            // dónde guardará el documento firmado
            ->setDirectorio('requisiciones/firmadas')                           // carpeta de salida de firmados (pública)
            ->setCorreo($usuario->email)                         // credenciales del proveedor de firma
            ->setClaveFirma($contrasenaFirma)                  // credenciales del proveedor de firma
            ->setRubricaUsuario(auth()->user()->rubrica ?? null)    // o la rúbrica del usuario
            ->setInicioX($x)                                        // coordenadas opcionales
            ->setInicioY($y)                                        // coordenadas opcionales
            ->setAncho(200)
            ->setAlto(35)
            ->setLugar('Guatemala, Guatemala')                      // opcional
            ->setTipoSolicitud('PDF')                               // opcional
            ->setConcepto('Requisición de compra')             // opcional
            ->setDocumento($uploaded)                                   // ← el PDF recién creado
            ->firmarDocumento();


        return $this->addMediaFromDisk($rutaArchivoFirmado, 'public') // ruta del archivo firmado
            ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);
    }

    /**
     * @param $contrasenaFirma
     * @return Media
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws Throwable
     */
    public function firmaSolicitante($contrasenaFirma): Media
    {

        $this->tiene_firma_solicitante = true;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA FIRMADA POR SOLICITANTE");


        $uploaded = $this->generarPdfUpload();


        if (config('firma-electronica.simular_firma')) {
            return $this
                ->addMedia($uploaded)
                ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);
        }


        return $this->firmar(
            usuarioAutenticado(),
            $contrasenaFirma,
            $uploaded
        );

    }

    /**
     * @throws Throwable
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function firmaOperador($contrasenaFirma): Media
    {

        $this->tiene_firma_aprobador = true;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA FIRMADA POR APROBADOR");

        $uploaded = $this->generarPdfUpload();

        if (config('firma-electronica.simular_firma')) {
            return $this
                ->addMedia($uploaded)
                ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);
        }

        return $this->firmar(
            usuarioAutenticado(),
            $contrasenaFirma,
            $uploaded
        );

    }

    /**
     * @throws Throwable
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function firmaAutorizador($contrasenaFirma): Media
    {

        $this->tiene_firma_autorizador = true;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA FIRMADA POR AUTORIZADOR");

        $uploaded = $this->generarPdfUpload();

        if (config('firma-electronica.simular_firma')) {
            return $this
                ->addMedia($uploaded)
                ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);
        }

        return $this->firmar(
            usuarioAutenticado(),
            $contrasenaFirma,
            $uploaded
        );

    }

    public function obtenerPartidas()
    {
        $partidas = [];

        $solicitudes = $this->compraSolicitudes;


        foreach ($solicitudes as $solicitud) {
            foreach ($solicitud->detalles as $detalle) {
                $partidas[] = $detalle->subProducto->producto->partida_parcial ?? null;
            }
        }


        return $partidas;

    }

    public function pdfFirmado()
    {
        return $this->getLastMediaUrl(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);
    }

}
