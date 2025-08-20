<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitudDetalle
 *
 * @property int $id
 * @property int $solicitud_id
 * @property int $activo_id
 * @property int $activo_tipo_id
 * @property int $solicitud_tipo_id
 * @property string|null $estado_del_bien
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Activo $activo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjetaDetalle> $activoTarjetaDetalles
 * @property-read int|null $activo_tarjeta_detalles_count
 * @property-read \App\Models\ActivoTipo $activoTipo
 * @property-read \App\Models\ActivoSolicitud $solicitud
 * @property-read \App\Models\ActivoSolicitudTipo $solicitudTipo
 * @method static \Database\Factories\ActivoSolicitudDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereActivoTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereEstadoDelBien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereSolicitudTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudDetalle withoutTrashed()
 * @mixin Model
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
        return $this->belongsTo(\App\Models\ActivoSolicitud::class, 'solicitud_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function activoTarjetaDetalles()
    {
        return $this->belongsToMany(\App\Models\ActivoTarjetaDetalle::class, 'activo_traslado');
    }
}
