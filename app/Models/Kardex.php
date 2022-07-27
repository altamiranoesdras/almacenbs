<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kardex
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 *
 * @property \App\Models\Item $item
 * @property \App\Models\User $usuario
 * @property integer $item_id
 * @property integer $model_id
 * @property string $model_type
 * @property number $cantidad
 * @property string $tipo
 * @property string $codigo
 * @property string $responsable
 * @property string $observacion
 * @property boolean $impreso
 * @property integer $usuario_id
 */
class Kardex extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kardexs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'item_id',
        'model_id',
        'model_type',
        'cantidad',
        'tipo',
        'codigo',
        'responsable',
        'observacion',
        'impreso',
        'usuario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'model_id' => 'integer',
        'model_type' => 'string',
        'cantidad' => 'decimal:2',
        'tipo' => 'string',
        'codigo' => 'string',
        'responsable' => 'string',
        'observacion' => 'string',
        'impreso' => 'boolean',
        'usuario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required',
        'model_id' => 'required|integer',
        'model_type' => 'required|string|max:255',
        'cantidad' => 'required|numeric',
        'tipo' => 'required|string',
        'codigo' => 'nullable|string|max:255',
        'responsable' => 'nullable|string|max:255',
        'observacion' => 'nullable|string',
        'impreso' => 'nullable|boolean',
        'usuario_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
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
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
