<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Compra1hDetalle
 * @package App\Models
 * @version July 27, 2022, 12:27 pm CST
 *
 * @property \App\Models\Compra1h $1h
 * @property \App\Models\Item $item
 * @property integer $1h_id
 * @property integer $item_id
 * @property number $precio
 * @property number $cantidad
 * @property integer $folio_almacen
 * @property integer $folio_inventario
 * @property string $codigo_inventario
 */
class Compra1hDetalle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'compra_1h_detalles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        '1h_id',
        'item_id',
        'precio',
        'cantidad',
        'folio_almacen',
        'folio_inventario',
        'codigo_inventario'
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
    public function 1h()
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
}
