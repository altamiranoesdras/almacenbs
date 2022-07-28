<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemTraslado
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 *
 * @property \App\Models\User $user
 * @property \App\Models\ItemsTrasladosEstado $estado
 * @property \App\Models\Item $itemDestino
 * @property \App\Models\Item $itemOrigen
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $item_origen
 * @property number $cantidad_origen
 * @property integer $item_destino
 * @property number $cantidad_destino
 * @property string $observaciones
 * @property integer $user_id
 * @property integer $estado_id
 */
class ItemTraslado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'items_traslados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'codigo',
        'correlativo',
        'item_origen',
        'cantidad_origen',
        'item_destino',
        'cantidad_destino',
        'observaciones',
        'user_id',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'item_origen' => 'integer',
        'cantidad_origen' => 'decimal:2',
        'item_destino' => 'integer',
        'cantidad_destino' => 'decimal:2',
        'observaciones' => 'string',
        'user_id' => 'integer',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|string|max:255',
        'correlativo' => 'required|integer',
        'item_origen' => 'required',
        'cantidad_origen' => 'nullable|numeric',
        'item_destino' => 'required',
        'cantidad_destino' => 'nullable|numeric',
        'observaciones' => 'nullable|string',
        'user_id' => 'required',
        'estado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ItemsTrasladosEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemDestino()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemOrigen()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_origen');
    }
}
