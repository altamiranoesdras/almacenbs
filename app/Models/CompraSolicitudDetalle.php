<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $solicitud_id
 * @property int $item_id
 * @property int $cantidad
 * @property string $precio_estimado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionDetalle> $compraRequisicionDetalles
 * @property-read int|null $compra_requisicion_detalles_count
 * @property-read mixed $sub_total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\CompraSolicitud $solicitud
 * @method static \Database\Factories\CompraSolicitudDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle wherePrecioEstimado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle withoutTrashed()
 * @mixin \Eloquent
 */
class CompraSolicitudDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitud_detalles';

    protected $appends = [
        'sub_total'
    ];

    public $fillable = [
        'solicitud_id',
        'item_id',
        'cantidad',
        'precio_estimado'
    ];

    protected $casts = [
        'precio_estimado' => 'decimal:2'
    ];

    public static $rules = [
        'solicitud_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required',
        'precio_estimado' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $mensajes =[
        'item_id.required' => 'El artículo es requerido',
        'cantidad.required' => 'La cantidad es requerida',
        'cantidad.integer' => 'La cantidad debe ser un entero',
        'precio_estimado.required' => 'El precio de compra es requerido',
        'precio_estimado.numeric' => 'El precio de compra debe ser un número',
    ];

    public function solicitud(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraSolicitud::class, 'solicitud_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function compraRequisicionDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicionDetalle::class, 'solicitud_detalle_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->cantidad * $this->precio_estimado;

    }
}
