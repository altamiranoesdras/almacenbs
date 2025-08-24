<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property int $requisicion_id
 * @property int $solicitud_detalle_id
 * @property int $item_id
 * @property string $cantidad
 * @property string $precio_estimado
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\CompraSolicitudDetalle $solicitudDetalle
 * @method static \Database\Factories\CompraRequisicionDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle wherePrecioEstimado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereRequisicionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionDetalle whereSolicitudDetalleId($value)
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
        'solicitud_detalle_id',
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
        'solicitud_detalle_id' => 'required',
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

    public function solicitudDetalle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraSolicitudDetalle::class, 'solicitud_detalle_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }
}
