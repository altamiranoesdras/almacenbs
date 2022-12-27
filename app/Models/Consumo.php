<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Consumo
 * @package App\Models
 * @version December 27, 2022, 11:27 am CST
 *
 * @property \App\Models\User $usuarioCrea
 * @property \App\Models\Bodega $bodega
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\ConsumoEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $consumoDetalles
 * @property integer $correlativo
 * @property string $codigo
 * @property integer $estado_id
 * @property integer $unidad_id
 * @property integer $bodega_id
 * @property integer $usuario_crea
 */
class Consumo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'consumos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'correlativo',
        'codigo',
        'estado_id',
        'unidad_id',
        'bodega_id',
        'usuario_crea'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'correlativo' => 'integer',
        'codigo' => 'string',
        'estado_id' => 'integer',
        'unidad_id' => 'integer',
        'bodega_id' => 'integer',
        'usuario_crea' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'correlativo' => 'nullable|integer',
        'codigo' => 'nullable|string|max:255',
        'estado_id' => 'required',
        'unidad_id' => 'nullable',
        'bodega_id' => 'nullable',
        'usuario_crea' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioCrea()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bodega()
    {
        return $this->belongsTo(\App\Models\Bodega::class, 'bodega_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ConsumoEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function consumoDetalles()
    {
        return $this->hasMany(\App\Models\ConsumoDetalle::class, 'consumo_id');
    }

    public function getCodigo($cantidadCeros = 3)
    {
        return "CMO-".prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = self::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

    public function scopeTemporal(Builder $q)
    {
        $q->where('estado_id',ConsumoEstado::TEMPORAL);
    }

    public function scopeNoTemporal(Builder $q)
    {
        $q->where('estado_id','!=',ConsumoEstado::TEMPORAL);
    }


    public function scopeDelUsuarioCrea($q,$user=null)
    {
        $user = $user ?? auth()->user() ?? auth('api')->user();


        $q->where('usuario_crea',$user->id);
    }

    public function esTemporal()
    {
        return $this->estado_id==ConsumoEstado::TEMPORAL;
    }

    public function puedeProcesar()
    {
        return $this->estado_id==ConsumoEstado::INGRESADO;
    }
}
