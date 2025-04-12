<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RrhhPuesto
 *
 * @package App\Models
 * @version August 4, 2022, 9:33 am CST
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property string $nombre
 * @property string $atribuciones
 * @property string $activo
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $users_count
 * @method static \Database\Factories\RrhhPuestoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newQuery()
 * @method static \Illuminate\Database\Query\Builder|RrhhPuesto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereAtribuciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|RrhhPuesto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RrhhPuesto withoutTrashed()
 * @mixin \Eloquent
 */
class RrhhPuesto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_puestos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'atribuciones',
        'activo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'atribuciones' => 'string',
        'activo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'atribuciones' => 'nullable|string',
        'activo' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'puesto_id');
    }
}
