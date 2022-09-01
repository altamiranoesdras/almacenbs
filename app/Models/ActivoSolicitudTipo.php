<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitudTipo
 * @package App\Models
 * @version August 31, 2022, 10:52 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property string $nombre
 */
class ActivoSolicitudTipo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_solicitud_tipos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


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
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'solicitud_tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudes()
    {
        return $this->hasMany(\App\Models\ActivoSolicitude::class, 'tipo_id');
    }
}
