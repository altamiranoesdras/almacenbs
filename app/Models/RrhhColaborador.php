<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RrhhColaborador
 *
 * @package App\Models
 * @version November 12, 2022, 10:35 am CST
 * @property \App\Models\RrhhPuesto $puesto
 * @property \App\Models\User $user
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitude1s
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetas
 * @property \Illuminate\Database\Eloquent\Collection $rrhhContratos
 * @property \Illuminate\Database\Eloquent\Collection $rrhhUnidade2s
 * @property string $nombres
 * @property string $apellidos
 * @property string $dpi
 * @property string $correo
 * @property string $telefono
 * @property string $direccion
 * @property string $nit
 * @property integer $puesto_id
 * @property integer $unidad_id
 * @property integer $user_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_tarjetas_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newQuery()
 * @method static \Illuminate\Database\Query\Builder|RrhhColaborador onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|RrhhColaborador withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RrhhColaborador withoutTrashed()
 * @mixin Model
 * @property-read int|null $activo_solicitude1s_count
 * @property-read int|null $activo_solicitudes_count
 * @property-read int|null $rrhh_unidade2s_count
 */
class RrhhColaborador extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_colaboradores';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $appends = ['nombre_completo'];

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombres',
        'apellidos',
        'dpi',
        'correo',
        'telefono',
        'direccion',
        'nit',
        'puesto_id',
        'unidad_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string',
        'dpi' => 'string',
        'correo' => 'string',
        'telefono' => 'string',
        'direccion' => 'string',
        'nit' => 'string',
        'puesto_id' => 'integer',
        'unidad_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'dpi' => 'nullable|string|max:13',
        'correo' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:45',
        'direccion' => 'nullable|string',
        'nit' => 'nullable|string|max:10',
        'puesto_id' => 'nullable',
        'unidad_id' => 'required',
        'user_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function getTextAttribute()
    {
        return $this->nombres.' '.$this->apellidos;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function puesto()
    {
        return $this->belongsTo(\App\Models\RrhhPuesto::class, 'puesto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudes()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'colaborador_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitude1s()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'colaborador_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoTarjetas()
    {
        return $this->hasMany(\App\Models\ActivoTarjeta::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rrhhContratos()
    {
        return $this->hasMany(\App\Models\RrhhContrato::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rrhhUnidade2s()
    {
        return $this->hasMany(\App\Models\RrhhUnidad::class, 'jefe_id');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombres." ".$this->apellidos;
    }
}
