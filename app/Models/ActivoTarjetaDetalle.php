<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoTarjetaDetalle
 *
 * @property int $id
 * @property int $tarjeta_id
 * @property int $activo_id
 * @property string $tipo
 * @property int $cantidad
 * @property string|null $valor
 * @property \Illuminate\Support\Carbon $fecha_asigna
 * @property int|null $unidad_id
 * @property int|null $impreso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Activo $activo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $activoSolicitudDetalles
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read mixed $valor_alza
 * @property-read mixed $valor_baja
 * @property-read \App\Models\ActivoTarjeta $tarjeta
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @method static \Database\Factories\ActivoTarjetaDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereActivoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereFechaAsigna($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereImpreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereTarjetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaDetalle withoutTrashed()
 * @mixin \Eloquent
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
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
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
