<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Consumo
 *
 * @package App\Models
 * @version December 27, 2022, 11:27 am CST
 * @property \App\Models\User $usuarioCrea
 * @property \App\Models\Bodega $bodega
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\ConsumoEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $correlativo
 * @property string $codigo
 * @property integer $estado_id
 * @property integer $unidad_id
 * @property integer $bodega_id
 * @property integer $usuario_crea
 * @property int $id
 * @property string|null $observaciones
 * @property string|null $fecha_procesa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $consumo_detalles_count
 * @method static Builder|Consumo delUsuarioCrea($user = null)
 * @method static \Database\Factories\ConsumoFactory factory(...$parameters)
 * @method static Builder|Consumo newModelQuery()
 * @method static Builder|Consumo newQuery()
 * @method static Builder|Consumo noTemporal()
 * @method static \Illuminate\Database\Query\Builder|Consumo onlyTrashed()
 * @method static Builder|Consumo query()
 * @method static Builder|Consumo temporal()
 * @method static Builder|Consumo whereBodegaId($value)
 * @method static Builder|Consumo whereCodigo($value)
 * @method static Builder|Consumo whereCorrelativo($value)
 * @method static Builder|Consumo whereCreatedAt($value)
 * @method static Builder|Consumo whereDeletedAt($value)
 * @method static Builder|Consumo whereEstadoId($value)
 * @method static Builder|Consumo whereId($value)
 * @method static Builder|Consumo whereObservaciones($value)
 * @method static Builder|Consumo whereUnidadId($value)
 * @method static Builder|Consumo whereUpdatedAt($value)
 * @method static Builder|Consumo whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Query\Builder|Consumo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Consumo withoutTrashed()
 * @mixin Model
 * @property-read int|null $detalles_count
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
        'usuario_crea',
        'observaciones',
        'fecha_procesa'
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
        'codigo' => 'nullable|string|max:255',
        'estado_id' => 'nullable',
        'unidad_id' => 'nullable',
        'bodega_id' => 'nullable',
        'usuario_crea' => 'nullable',
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
    public function detalles()
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

    public function egreso()
    {

        /**
         * @var ConsumoDetalle $detalle
         */
        foreach ($this->detalles as $detalle){
            $detalle->egreso();
        }

    }

    public function puedeEditar()
    {
        return in_array($this->estado_id,[
            ConsumoEstado::TEMPORAL,
            ConsumoEstado::INGRESADO,
        ]);
    }

    public function puedeAnular()
    {
        return in_array($this->estado_id,[
            ConsumoEstado::PROCESADO,
        ]);
    }

    public function anular()
    {
        $this->estado_id = ConsumoEstado::ANULADO;
        $this->save();


        /**
         * @var ConsumoDetalle $detalle
         */
        foreach ($this->detalles as $detalle){
            $detalle->anular();
        }
    }
}
