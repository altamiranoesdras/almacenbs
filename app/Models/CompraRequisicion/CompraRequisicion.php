<?php

namespace App\Models\CompraRequisicion;

use App\FirmaElectronica\FirmaElectronica;
use App\Models\CompraRequisicionEstado;
use App\Models\CompraSolicitud;
use App\Models\User;
use App\Traits\HasBitacora;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
 * @property \Illuminate\Support\Carbon|null $fecha_solicita
 * @property \Illuminate\Support\Carbon|null $fecha_aprueba
 * @property int|null $usuario_solicita_id
 * @property \Illuminate\Support\Carbon|null $fecha_autoriza
 * @property bool|null $tiene_firma_solicitante
 * @property bool|null $tiene_firma_aprobador
 * @property bool|null $tiene_firma_autorizador
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CompraSolicitud> $compraSolicitudes
 * @property-read int|null $compra_solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read CompraRequisicionEstado $estado
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Proveedor|null $proveedorAdjudicado
 * @property-read \App\Models\CompraRequisicionTipoAdquisicion|null $tipoAdquisicion
 * @property-read \App\Models\CompraRequisicionTipoConcurso|null $tipoConcurso
 * @property-read \App\Models\RrhhUnidad $unidad
 * @method static \Database\Factories\CompraRequisicion\CompraRequisicionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCodigoConsolidacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereFechaAprueba($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereFechaAutoriza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereFechaSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNpg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNumeroAdjudicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion wherePartidas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereProveedorAdjudicado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereSubproductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTieneFirmaAprobador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTieneFirmaAutorizador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTieneFirmaSolicitante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTipoAdquisicionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTipoConcursoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioAnalistaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioApruebaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioAsignaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioAutorizaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioCreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUsuarioSolicitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion withoutTrashed()
 * @mixin \Eloquent
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
        'tipo_adquisicion_id',
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
        'tiene_firma_autorizador'
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

    public static $rules = [
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

    public static $messages = [

    ];

    const COLLECTION_REQUISICION_COMPRA = 'requisicion_compra';

    protected static function booted()
    {
        /**
         * Genera el código de la requisición al momento de crearla.
         * @var CompraRequisicion $requisicion
         *
         */
        static::created(function ($requisicion) {
            $year = now()->year;
            $numero = str_pad($requisicion->id, 3, '0', STR_PAD_LEFT);
            $requisicion->codigo = "G-{$year}-{$numero}";
            $requisicion->codigo_consolidacion = "L-{$year}-{$numero}";
            $requisicion->save();
        });
    }

    public function tipoAdquisicion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicionTipoAdquisicion::class, 'tipo_adquisicion_id');
    }

    public function tipoConcurso(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicionTipoConcurso::class, 'tipo_concurso_id');
    }

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    public function proveedorAdjudicado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Proveedor::class, 'proveedor_adjudicado');
    }

    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicionEstado::class, 'estado_id');
    }

//    public function compraOrdenes(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(\App\Models\CompraOrdene::class, 'gestion_id');
//    }

    public function detalles(): HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicionDetalle::class, 'requisicion_id');
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

        $this->addBitacora("REQUISICIÓN DE COMPRA SOLICITADA","");
    }

    public function aprobar(): void
    {
        $this->estado_id = CompraRequisicionEstado::APROBADA;
        $this->fecha_aprueba = now();
        $this->usuario_aprueba_id = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA APROBADA","");
    }

    public function autorizar(): void
    {
        $this->estado_id = CompraRequisicionEstado::AUTORIZADA;
        $this->fecha_autoriza = now();
        $this->usuario_autoriza_id = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA AUTORIZADA","");
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
        return $this->estado_id == CompraRequisicionEstado::APROBADA && $this->tiene_firma_autorizador;
    }

    //TODO: Esta función debe de completarse.
    public function puedeAprobarSupervisor(): bool
    {
        return $this->estado_id == CompraRequisicionEstado::AUTORIZADA || $this->estado_id == CompraRequisicionEstado::ASIGNACION_REQUISICIONES;
    }

    //TODO: Esta función debe de completarse.
    public function supervisorVistoBueno($comentario = ''): void
    {
        if ($this->estado_id == CompraRequisicionEstado::AUTORIZADA ||
            $this->estado_id == CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR)
        {
            $this->estado_id = CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS;
        } else {
            $this->estado_id = CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS;
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

        $this->addBitacora("REQUISICIÓN DE COMPRA APROBADA POR ANALISTA DE PRESUPUESTO", $comentario);

    }

    public function analistaPresupuestoRetorna($comentario=''): void
    {
        $this->estado_id = CompraRequisicionEstado::RETORNADA_POR_ANALISTA_DE_PRESUPUESTO_A_SUPERVISOR;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA RETORNADA POR ANALISTA DE PRESUPUESTO", $comentario);
    }


    public function getLastMediaUrl(string $collection = 'default', string $conversion = ''): ?string
    {
        return $this->getMedia($collection)
            ->sortByDesc('created_at')
            ->first()?->getUrl($conversion);

    }

    public function puedeEditar()
    {
        return in_array($this->estado_id, [
            CompraRequisicionEstado::CREADA,
        ]);
    }

    public function puedeAnular()
    {
        return $this->estado_id != CompraRequisicionEstado::CANCELADA;
    }

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
        $folderPdf = 'requisiciones/generadas';              // carpeta para PDFs generados (previos a la firma)
        $filename = 'Requisicion_' . $this->id . '_' . time() . '.pdf';
        $relativePdfPath = $folderPdf . '/' . $filename;

        $binary = $pdf->output();
        Storage::disk($disk)->put($relativePdfPath, $binary);

        // 3) Envolver el archivo como UploadedFile para pasarlo al firmador
        $absolutePdfPath = Storage::disk($disk)->path($relativePdfPath);
        $uploaded = new UploadedFile(
            $absolutePdfPath,
            $filename,
            'application/pdf',
            null,
            true // test mode (no mueve/elimina el archivo fuente)
        );

        return $uploaded;
    }

    public function firmar(User $usuario,string $contrasenaFirma, UploadedFile $uploaded): Media
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


        $media = $this
            ->addMediaFromDisk($rutaArchivoFirmado, 'public') // ruta del archivo firmado
            ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);

        return $media;
    }

    /**
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function firmaSolicitante($contrasenaFirma): Media
    {

        $this->tiene_firma_solicitante = true;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA FIRMADA POR SOLICITANTE", "");


        $uploaded = $this->generarPdfUpload();


        if (config('firma-electronica.simular_firma')) {
            // Simula la firma con el PDF generado
//            return $this
//                ->addMediaFromUrl($uploaded->getRealPath(), 'public') // Simula la firma con el PDF generado
//                ->toMediaCollection(CompraRequisicion::COLLECTION_REQUISICION_COMPRA);
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

    public function firmaOperador($contrasenaFirma): Media
    {

        $this->tiene_firma_aprobador = true;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA FIRMADA POR APROBADOR", "");

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

    public function firmaAutorizador($contrasenaFirma): Media
    {

        $this->tiene_firma_autorizador = true;
        $this->save();

        $this->addBitacora("REQUISICIÓN DE COMPRA FIRMADA POR AUTORIZADOR", "");

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

}
