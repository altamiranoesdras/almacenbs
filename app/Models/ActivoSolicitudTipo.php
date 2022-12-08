<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitudTipo
 *
 * @package App\Models
 * @version August 31, 2022, 10:52 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activo_solicitud_detalles_count
 * @method static \Database\Factories\ActivoSolicitudTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudTipo withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $activo_solicitudes_count
 */
class ActivoSolicitudTipo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_solicitud_tipos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    const TIPO_1 = 1;
    const TIPO_2 = 2;

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
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'solicitud_tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudes()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'tipo_id');
    }
}
