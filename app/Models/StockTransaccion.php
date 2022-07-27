<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StockTransaccion
 * @package App\Models
 * @version July 27, 2022, 12:26 pm CST
 *
 * @property \App\Models\Stock $stock
 * @property string $model_type
 * @property integer $model_id
 * @property integer $stock_id
 * @property string $tipo
 * @property number $cantidad
 * @property number $precio_costo
 */
class StockTransaccion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stocks_transacciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'model_type',
        'model_id',
        'stock_id',
        'tipo',
        'cantidad',
        'precio_costo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'model_type' => 'string',
        'model_id' => 'integer',
        'stock_id' => 'integer',
        'tipo' => 'string',
        'cantidad' => 'decimal:2',
        'precio_costo' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'model_type' => 'required|string|max:255',
        'model_id' => 'required',
        'stock_id' => 'required',
        'tipo' => 'required|string',
        'cantidad' => 'required|numeric',
        'precio_costo' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function stock()
    {
        return $this->belongsTo(\App\Models\Stock::class, 'stock_id');
    }
}
