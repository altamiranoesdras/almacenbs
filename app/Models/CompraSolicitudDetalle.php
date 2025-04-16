<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * Class ComprasolicitudDetalle
 *
 * @package App\Models
 * @version April 18, 2024, 9:29 pm CST
 * @property \App\Models\Item $item
 * @property \App\Models\CompraSolicitud $solicitud
 * @property integer $solicitud_id
 * @property integer $item_id
 * @property integer $cantidad
 * @property number $precio_venta
 * @property number $precio_compra
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $sub_total
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
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle wherePrecioCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudDetalle wherePrecioVenta($value)
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

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['sub_total'];

    public $fillable = [
        'solicitud_id',
        'item_id',
        'cantidad',
        'precio_venta',
        'precio_compra'
    ];

    protected $casts = [
        'precio_venta' => 'decimal:2',
        'precio_compra' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'solicitud_id' => 'required',
        'item_id' => 'required|integer',
        'cantidad' => 'required|integer',
        'precio_venta' => 'nullable|numeric',
        'precio_compra' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $mensajes =[
        'item_id.required' => 'El artículo es requerido',
        'cantidad.required' => 'La cantidad es requerida',
        'cantidad.integer' => 'La cantidad debe ser un entero',
        'precio_compra.required' => 'El precio de compra es requerido',
        'precio_compra.numeric' => 'El precio de compra debe ser un número',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function solicitud()
    {
        return $this->belongsTo(\App\Models\CompraSolicitud::class, 'solicitud_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->cantidad * $this->precio_compra;

    }
}
