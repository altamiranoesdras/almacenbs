<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ConsumoDetalle
 * @package App\Models
 * @version December 27, 2022, 11:03 am CST
 *
 * @property \App\Models\Consumo $consumo
 * @property \App\Models\Item $item
 * @property integer $consumo_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property string $fecha_vence
 * @property string $observaciones
 */
class ConsumoDetalle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'consumo_detalles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'consumo_id',
        'item_id',
        'cantidad',
        'precio',
        'fecha_vence',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'consumo_id' => 'integer',
        'item_id' => 'integer',
        'cantidad' => 'decimal:0',
        'precio' => 'decimal:0',
        'fecha_vence' => 'date',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'consumo_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio' => 'nullable|numeric',
        'fecha_vence' => 'nullable',
        'observaciones' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function consumo()
    {
        return $this->belongsTo(\App\Models\Consumo::class, 'consumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }
}
