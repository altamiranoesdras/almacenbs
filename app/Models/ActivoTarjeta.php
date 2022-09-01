<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoTarjeta
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 *
 * @property \App\Models\User $responsable
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetaDetalles
 * @property integer $responsable_id
 * @property string $codigo
 * @property integer $correlativo
 */
class ActivoTarjeta extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_tarjetas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'responsable_id',
        'codigo',
        'correlativo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'responsable_id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'responsable_id' => 'required',
        'codigo' => 'nullable|string|max:45',
        'correlativo' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function responsable()
    {
        return $this->belongsTo(\App\Models\User::class, 'responsable_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudes()
    {
        return $this->hasMany(\App\Models\ActivoSolicitude::class, 'tarjeta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoTarjetaDetalles()
    {
        return $this->hasMany(\App\Models\ActivoTarjetaDetalle::class, 'tarjeta_id');
    }
}
