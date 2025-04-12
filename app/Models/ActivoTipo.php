<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoTipo
 *
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $activos
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $activos_count
 * @property-read mixed $text_corto
 * @method static \Database\Factories\ActivoTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ActivoTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivoTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ActivoTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ActivoTipo withoutTrashed()
 * @mixin \Eloquent
 */
class ActivoTipo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_tipos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const ACTIVO_FIJO = 1;
    const BIEN_FUNGIBLE = 2;

    protected $dates = ['deleted_at'];

    protected $appends = ['text_corto'];

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
    public function activos()
    {
        return $this->hasMany(\App\Models\Activo::class, 'tipo_id');
    }

    public function getTextCortoAttribute()
    {
        return $this->id == self::ACTIVO_FIJO ? 'AF' : 'BF';
    }

}
