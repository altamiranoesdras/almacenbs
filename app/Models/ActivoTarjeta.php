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
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $colaborador_id
 * @property string $codigo
 * @property string $codigo_referencia
 * @property integer $correlativo
 * @property boolean $impreso
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
        'codigo_referencia',
        'correlativo',
        'usuario_crea',
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
        return $this->hasMany(\App\Models\ActivoSolicitude::class, 'tarjeta_id');
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
