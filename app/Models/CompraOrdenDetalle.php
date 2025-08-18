<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $orden_id
 * @property int $item_id
 * @property string $cantidad
 * @property string $precio
 * @property string|null $observacion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $item
 * @method static \Database\Factories\CompraOrdenDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereOrdenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrdenDetalle withoutTrashed()
 * @mixin \Eloquent
 */
class CompraOrdenDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_orden_detalles';

    public $fillable = [
        'orden_id',
        'item_id',
        'cantidad',
        'precio',
        'observacion'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'precio' => 'decimal:2',
        'observacion' => 'string'
    ];

    public static $rules = [
        'orden_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio' => 'required|numeric',
        'observacion' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function orden(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraOrdene::class, 'orden_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }
}
