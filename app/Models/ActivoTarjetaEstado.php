<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoTarjetaEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ActivoTarjeta> $activoTarjetas
 * @property-read int|null $activo_tarjetas_count
 * @method static \Database\Factories\ActivoTarjetaEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTarjetaEstado withoutTrashed()
 * @mixin Model
 */
class ActivoTarjetaEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    const TEMPORAL = 1;
    const CREADA = 2;

    public $table = 'activo_tarjeta_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


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
    public function activoTarjetas()
    {
        return $this->hasMany(\App\Models\ActivoTarjeta::class, 'estado_id');
    }
}
