<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoTarjetaDetalle
 * @package App\Models
 * @version September 4, 2022, 7:56 pm CST
 *
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\Activo $activo
 * @property \App\Models\ActivoTarjeta $tarjeta
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property integer $tarjeta_id
 * @property integer $activo_id
 * @property string $tipo
 * @property integer $cantidad
 * @property number $valor
 * @property string $fecha_asigna
 * @property integer $unidad_id
 * @property boolean $impreso
 */
class ActivoTarjetaDetalle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_tarjeta_detalles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const ALZA = 'alza';
    const BAJA = 'baja';


    protected $dates = ['deleted_at'];
    protected $appends = ['valor_alza','valor_baja'];



    public $fillable = [
        'tarjeta_id',
        'activo_id',
        'tipo',
        'cantidad',
        'valor',
        'fecha_asigna',
        'unidad_id',
        'impreso'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tarjeta_id' => 'integer',
        'activo_id' => 'integer',
        'tipo' => 'string',
        'cantidad' => 'integer',
        'valor' => 'decimal:2',
        'fecha_asigna' => 'date',
        'unidad_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tarjeta_id' => 'required',
        'activo_id' => 'required',
        'tipo' => 'nullable|string',
        'cantidad' => 'nullable|integer',
        'valor' => 'required|numeric',
        'fecha_asigna' => 'required',
        'unidad_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidade::class, 'unidad_id');
    }

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
    public function tarjeta()
    {
        return $this->belongsTo(\App\Models\ActivoTarjeta::class, 'tarjeta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function activoSolicitudDetalles()
    {
        return $this->belongsToMany(\App\Models\ActivoSolicitudDetalle::class, 'activo_traslado');
    }

    public function getValorAlzaAttribute()
    {
        return $this->tipo==self::ALZA ? $this->valor : null;
    }


    public function getValorBajaAttribute()
    {
        return $this->tipo==self::BAJA ? $this->valor : null;
    }
}
