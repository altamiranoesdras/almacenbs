<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Compra1hDetalle
 *
 * @package App\Models
 * @version July 27, 2022, 12:27 pm CST
 * @property \App\Models\Compra1h $1h
 * @property \App\Models\Item $item
 * @property integer $1h_id
 * @property integer $item_id
 * @property number $precio
 * @property number $cantidad
 * @property integer $folio_almacen
 * @property integer $folio_inventario
 * @property string $codigo_inventario
 * @property string $texto_extra
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1h $compra1h
 * @property-read mixed $sub_total
 * @method static \Database\Factories\Compra1hDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|Compra1hDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle where1hId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereCodigoInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereFolioAlmacen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereFolioInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1hDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Compra1hDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra1hDetalle withoutTrashed()
 * @mixin \Eloquent
 */
class Compra1hDetalle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'compra_1h_detalles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['sub_total'];

    public $fillable = [
        '1h_id',
        'item_id',
        'precio',
        'cantidad',
        'folio_almacen',
        'folio_inventario',
        'codigo_inventario',
        'texto_extra'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        '1h_id' => 'integer',
        'item_id' => 'integer',
        'precio' => 'decimal:5',
        'cantidad' => 'decimal:5',
        'folio_almacen' => 'integer',
        'folio_inventario' => 'integer',
        'codigo_inventario' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        '1h_id' => 'required',
        'item_id' => 'required',
        'precio' => 'required|numeric',
        'cantidad' => 'required|numeric',
        'folio_almacen' => 'required|integer',
        'folio_inventario' => 'nullable|integer',
        'codigo_inventario' => 'nullable|string|max:50',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function compra1h()
    {
        return $this->belongsTo(\App\Models\Compra1h::class, '1h_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->cantidad * $this->precio;
    }

    public function getTextAttribute()
    {
        $textoExtra = $this->texto_extra ? " / ".$this->texto_extra : '';
        return $this->item->texto_principal.$textoExtra;
    }
}
