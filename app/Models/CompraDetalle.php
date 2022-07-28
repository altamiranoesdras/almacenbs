<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CompraDetalle
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 *
 * @property \App\Models\Compra $compra
 * @property \App\Models\Item $item
 * @property integer $compra_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property number $descuento
 * @property string $fecha_ven
 */
class CompraDetalle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'compra_detalles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'compra_id',
        'item_id',
        'cantidad',
        'precio',
        'descuento',
        'fecha_ven'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'compra_id' => 'integer',
        'item_id' => 'integer',
        'cantidad' => 'decimal:2',
        'precio' => 'decimal:2',
        'descuento' => 'decimal:2',
        'fecha_ven' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'compra_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio' => 'required|numeric',
        'descuento' => 'required|numeric',
        'fecha_ven' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function compra()
    {
        return $this->belongsTo(\App\Models\Compra::class, 'compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }
}
