<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Colaborador
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjeta> $activoTarjetas
 * @property-read int|null $activo_tarjetas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhContrato> $contratos
 * @property-read int|null $contratos_count
 * @property-read mixed $nombre_completo
 * @property-read mixed $text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhUnidad> $jefe
 * @property-read int|null $jefe_count
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $solicitudDestino
 * @property-read int|null $solicitud_destino_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $solicitudOrigen
 * @property-read int|null $solicitud_origen_count
 * @property-read \App\Models\RrhhUnidad $unidad
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ColaboradorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador query()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Colaborador withoutTrashed()
 * @mixin \Eloquent
 */
class Colaborador extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_colaboradores';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['nombre_completo','text'];

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
        'puesto_id' => 'required',
        'unidad_id' => 'required',
        'user_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

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
    public function solicitudOrigen()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'colaborador_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudDestino()
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
    public function contratos()
    {
        return $this->hasMany(\App\Models\RrhhContrato::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function jefe()
    {
        return $this->hasMany(\App\Models\RrhhUnidad::class, 'jefe_id');
    }

    public function getTextAttribute()
    {
        return $this->nit." - ".$this->nombres." ".$this->apellidos." / ".($this->unidad->nombre ?? '');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombres." ".$this->apellidos;
    }
}
