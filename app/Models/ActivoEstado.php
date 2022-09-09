<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoEstado
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $activos
 * @property string $nombre
 */
class ActivoEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const BUEN_ESTADO = 1;
    const REGULAR = 2;
    const MAL_ESTADO_OBSOLETO = 3;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudDetalles()
    {
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activos()
    {
        return $this->hasMany(\App\Models\Activo::class, 'estado_id');
    }
}
