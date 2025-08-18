<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $tipo_concurso_id
 * @property int $ipo_adquisicion_id
 * @property int|null $correlativo
 * @property string $codigo ID interno de gestión, p.ej. G-2025-001
 * @property string|null $codigo_consolidacion Código de lote interno, p.ej. L-2025-001
 * @property string|null $npg Número de Publicación (Compra Menor)
 * @property string|null $nog Número de Operación (Licitación Abreviada)
 * @property int|null $proveedor_adjudicado
 * @property string|null $numero_adjudicacion
 * @property int $estado_id
 * @property string|null $subproductos
 * @property string|null $partidas
 * @property string|null $observaciones
 * @property string|null $justificacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionDetalle> $compraRequisicionDetalles
 * @property-read int|null $compra_requisicion_detalles_count
 * @property-read \App\Models\CompraRequicicionEstado $estado
 * @property-read \App\Models\CompraRequisicionTipoConcurso $tipoConcurso
 * @method static \Database\Factories\CompraRequisicionFactory factory($count = null, $state = [])
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
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereIpoAdquisicionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNpg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereNumeroAdjudicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion wherePartidas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereProveedorAdjudicado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereSubproductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereTipoConcursoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicion withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequisicion extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisiciones';

    public $fillable = [
        'tipo_concurso_id',
        'ipo_adquisicion_id',
        'correlativo',
        'codigo',
        'codigo_consolidacion',
        'npg',
        'nog',
        'proveedor_adjudicado',
        'numero_adjudicacion',
        'estado_id',
        'subproductos',
        'partidas',
        'observaciones',
        'justificacion'
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
        'justificacion' => 'string'
    ];

    public static $rules = [
        'tipo_concurso_id' => 'required',
        'ipo_adquisicion_id' => 'required',
        'correlativo' => 'nullable',
        'codigo' => 'required|string|max:20',
        'codigo_consolidacion' => 'nullable|string|max:45',
        'npg' => 'nullable|string|max:45',
        'nog' => 'nullable|string|max:45',
        'proveedor_adjudicado' => 'nullable',
        'numero_adjudicacion' => 'nullable|string|max:45',
        'estado_id' => 'required',
        'subproductos' => 'nullable|string|max:45',
        'partidas' => 'nullable|string|max:45',
        'observaciones' => 'nullable|string|max:65535',
        'justificacion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function ipoAdquisicion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequicicionTipoAdquisicione::class, 'ipo_adquisicion_id');
    }

    public function tipoConcurso(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicionTipoConcurso::class, 'tipo_concurso_id');
    }

    public function proveedorAdjudicado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Proveedore::class, 'proveedor_adjudicado');
    }

    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequicicionEstado::class, 'estado_id');
    }

    public function compraOrdenes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraOrdene::class, 'gestion_id');
    }

    public function compraRequisicionDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicionDetalle::class, 'requisicion_id');
    }

    public function compraSolicitudes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraSolicitude::class, 'compra_solicitud_has_requisicion');
    }
}
