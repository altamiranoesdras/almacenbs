<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitudDetalle> $activoSolicitudDetalles
 * @property-read int|null $activo_solicitud_detalles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activo> $activos
 * @property-read int|null $activos_count
 * @method static \Database\Factories\ActivoEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoEstado withoutTrashed()
 * @mixin \Eloquent
 */
class ActivoEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const BUEN_ESTADO = 1;
    const REGULAR = 2;
    const MAL_ESTADO_OBSOLETO = 3;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudDetalles()
    {
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activos()
    {
        return $this->hasMany(\App\Models\Activo::class, 'estado_id');
    }
}
