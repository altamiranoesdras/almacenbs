<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitudEstado
 *
 * @package App\Models
 * @version August 31, 2022, 10:52 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudes
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ActivoSolicitudEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoSolicitudEstado withoutTrashed()
 * @property-read int|null $activo_solicitudes_count
 * @mixin \Eloquent
 */
class ActivoSolicitudEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_solicitud_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const TEMPORAL = 1;
    const INGRESADA = 2;
    const SOLICITADA = 3;
    const AUTORIZADA = 4;
    const APROBADA = 5;
    const DESPACHADA = 6;
    const ANULADA = 7;
    const CANCELADA = 8;

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
    public function activoSolicitudes()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'estado_id');
    }
}
