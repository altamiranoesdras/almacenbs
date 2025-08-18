<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoTarjeta
 *
 * @property int $id
 * @property int|null $colaborador_id
 * @property string|null $codigo
 * @property string|null $codigo_interno
 * @property int|null $correlativo
 * @property int|null $impreso
 * @property int $usuario_crea
 * @property int $estado_id
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjetaDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\Colaborador|null $responsable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \App\Models\User $usuarioCrea
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta delUsuarioCrea($user = null)
 * @method static \Database\Factories\ActivoTarjetaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta noTemporal()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCodigoInterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereImpreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjeta withoutTrashed()
 * @mixin \Eloquent
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
        'colaborador_id',
        'codigo',
        'codigo_interno',
        'correlativo',
        'usuario_crea',
        'estado_id',
        'impreso'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'colaborador_id' => 'integer',
        'estado_id' => 'integer',
        'usuario_crea' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'colaborador_id' => 'required',
        'usuario_crea' => 'nullable',
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
        return $this->belongsTo(\App\Models\Colaborador::class, 'colaborador_id');
    }

    public function usuarioCrea()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'tarjeta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
    {
        return $this->hasMany(\App\Models\ActivoTarjetaDetalle::class, 'tarjeta_id');
    }

    public function tieneDetallesImpresos()
    {
        return $this->detalles->where('impreso', true)->isNotEmpty();
    }

    public function scopeTemporal($q)
    {
        $q->where('estado_id',ActivoTarjetaEstado::TEMPORAL);
    }

    public function scopeDelUsuarioCrea($q,$user=null)
    {
        $user = $user ?? auth()->user() ?? auth('api')->user();


        $q->where('usuario_crea',$user->id);
    }

    public function scopeNoTemporal($q)
    {
        $q->where('estado_id','!=',ActivoTarjetaEstado::TEMPORAL);
    }

}
