<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitudDetalle
 * @package App\Models
 * @version November 11, 2022, 2:58 pm CST
 *
 * @property \App\Models\Activo $activo
 * @property \App\Models\ActivoSolicitudTipo $solicitudTipo
 * @property \App\Models\ActivoTipo $activoTipo
 * @property \App\Models\ActivoSolicitude $solicitud
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetaDetalles
 * @property integer $solicitud_id
 * @property integer $activo_id
 * @property integer $activo_tipo_id
 * @property integer $solicitud_tipo_id
 * @property string $estado_del_bien
 * @property string $observaciones
 */
class ActivoSolicitudDetalle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_solicitud_detalles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'solicitud_id',
        'activo_id',
        'activo_tipo_id',
        'solicitud_tipo_id',
        'estado_del_bien',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'solicitud_id' => 'integer',
        'activo_id' => 'integer',
        'activo_tipo_id' => 'integer',
        'solicitud_tipo_id' => 'integer',
        'estado_del_bien' => 'string',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'solicitud_id' => 'required',
        'activo_id' => 'required',
        'activo_tipo_id' => 'required',
        'solicitud_tipo_id' => 'required',
        'estado_del_bien' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activo()
    {
        return $this->belongsTo(\App\Models\Activo::class, 'activo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function solicitudTipo()
    {
        return $this->belongsTo(\App\Models\ActivoSolicitudTipo::class, 'solicitud_tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activoTipo()
    {
        return $this->belongsTo(\App\Models\ActivoTipo::class, 'activo_tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function solicitud()
    {
        return $this->belongsTo(\App\Models\ActivoSolicitude::class, 'solicitud_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function activoTarjetaDetalles()
    {
        return $this->belongsToMany(\App\Models\ActivoTarjetaDetalle::class, 'activo_traslado');
    }
}
