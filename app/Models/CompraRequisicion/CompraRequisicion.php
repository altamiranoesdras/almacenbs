<?php

namespace App\Models\CompraRequisicion;

use App\Models\CompraSolicitud;
use App\Traits\HasBitacora;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\CompraRequisicionEstado;
/**
 * 
 *
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
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
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


}
