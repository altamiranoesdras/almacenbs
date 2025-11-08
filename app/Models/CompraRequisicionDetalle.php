<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $requisicion_id
 * @property int $item_id
 * @property string $cantidad
 * @property string $precio_estimado
 * @property int|null $sub_producto_id
 * @property int|null $financiamiento_fuente_id
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $sub_total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\CompraRequisicion\CompraRequisicion $requisicion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraSolicitudDetalle> $solicitudDetalles
 * @property-read int|null $solicitud_detalles_count
 * @method static \Database\Factories\CompraRequisicionDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereFinanciamientoFuenteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle wherePrecioEstimado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereRequisicionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereSubProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequisicionDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_detalles';

    public $fillable = [
        'requisicion_id',
        'item_id',
        'cantidad',
        'precio_estimado',
        'observaciones'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'precio_estimado' => 'decimal:2',
        'observaciones' => 'string'
    ];

    public static $rules = [
        'requisicion_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio_estimado' => 'required|numeric',
        'observaciones' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function requisicion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicion\CompraRequisicion::class, 'requisicion_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->cantidad * $this->precio_estimado;

    }

    public function solicitudDetalles(): BelongsToMany
    {
        return $this->belongsToMany(
            CompraSolicitudDetalle::class,
            'compra_solicitud_detalle_has_requisicion_detalle',
            'requisicion_detalle_id',
            'compra_solicitud_detalle_id'
        );

    }
}
