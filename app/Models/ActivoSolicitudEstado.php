<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitudEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoSolicitud> $activoSolicitudes
 * @property-read int|null $activo_solicitudes_count
 * @method static \Database\Factories\ActivoSolicitudEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoSolicitudEstado withoutTrashed()
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
