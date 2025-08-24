<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RrhhUnidad
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int|null $centro_id
 * @property int $unidad_tipo_id
 * @property int|null $unidad_padre_id
 * @property int|null $jefe_id
 * @property string $activa
 * @property string $solicita
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, RrhhUnidad> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\User|null $jefe
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhPuesto> $puestos
 * @property-read int|null $puestos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuarios
 * @property-read int|null $usuarios_count
 * @method static \Database\Factories\RrhhUnidadFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad padres()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereActiva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereCentroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereJefeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereUnidadPadreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereUnidadTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidad withoutTrashed()
 * @property-read string $text
 * @property-read \App\Models\RrhhUnidadTipo $tipo
 * @mixin \Eloquent
 */
class RrhhUnidad extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_unidades';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const PRINCIPAL = 1;


    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
        'codigo',
        'unidad_tipo_id',
        'unidad_padre_id',
        'jefe_id',
        'activa',
        'solicita',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'jefe_id' => 'integer',
        'activa' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'jefe_id' => 'integer|exists:users,id',
        'codigo' => 'required|string|max:255|unique:rrhh_unidades,codigo',
        'unidad_tipo_id' => 'required|integer|exists:rrhh_unidad_tipos,id',
        'activa' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return BelongsTo
     **/
    public function jefe()
    {
        return $this->belongsTo(User::class, 'jefe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function puestos()
    {
        return $this->belongsToMany(RrhhPuesto::class, 'puesto_has_unidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usuarios()
    {
        return $this->hasMany(User::class, 'unidad_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(RrhhUnidad::class,'unidad_padre_id','id')
            ->with('children');
    }

    public function scopePadres($query)
    {
        return $query->whereNull('rrhh_unidades.unidad_padre_id');
    }

    public function isChildren(): bool
    {
        return !is_null($this->option_id);
    }

    public function hasChildren(): bool
    {
        return $this->children->count()>0;
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(RrhhUnidadTipo::class, 'unidad_tipo_id');

    }

    public function getTextAttribute(): string
    {
        return $this->codigo . ' - ' . $this->nombre . ' (' . $this->tipo->nombre . ')';

    }
}
