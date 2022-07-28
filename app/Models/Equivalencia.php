<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Equivalencia
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 *
 * @property \App\Models\Item $itemOrigen
 * @property \App\Models\Item $itemDestino
 * @property integer $item_origen
 * @property integer $item_destino
 * @property number $cantidad
 */
class Equivalencia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'equivalencias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'item_origen',
        'item_destino',
        'cantidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_origen' => 'integer',
        'item_destino' => 'integer',
        'cantidad' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_origen' => 'required',
        'item_destino' => 'required',
        'cantidad' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemOrigen()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemDestino()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_destino');
    }
}
