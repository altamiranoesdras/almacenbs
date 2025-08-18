<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RrhhColaborador
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $dpi
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $direccion
 * @property string|null $nit
 * @property int|null $puesto_id
 * @property int $unidad_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitude1s
 * @property-read int|null $activo_solicitude1s_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitudes
 * @property-read int|null $activo_solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjeta> $activoTarjetas
 * @property-read int|null $activo_tarjetas_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhContrato> $rrhhContratos
 * @property-read int|null $rrhh_contratos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhUnidad> $rrhhUnidade2s
 * @property-read int|null $rrhh_unidade2s_count
 * @property-read \App\Models\RrhhUnidad $unidad
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador onlyTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhColaborador withoutTrashed()
 * @mixin Model
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
