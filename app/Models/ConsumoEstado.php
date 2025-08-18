<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ConsumoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Consumo> $consumos
 * @property-read int|null $consumos_count
 * @method static \Database\Factories\ConsumoEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoEstado withoutTrashed()
 * @mixin Model
 */
class ConsumoEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'consumo_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const TEMPORAL =    1;
    const INGRESADO =   2;
    const PROCESADO =   3;
    const ANULADO =     4;


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
    public function consumos()
    {
        return $this->hasMany(\App\Models\Consumo::class, 'estado_id');
    }
}
