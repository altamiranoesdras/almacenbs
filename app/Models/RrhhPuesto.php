<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RrhhPuesto
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $atribuciones
 * @property string|null $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RrhhPuestoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereAtribuciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhPuesto withoutTrashed()
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

    public const JEFE_DEPARTAMENTO_ALMACEN = 1;
    public const ENCARGADA_DE_BODEGA = 2;
    public const AUXILIAR_DE_BODEGA = 3;
    public const ANALISTA_ALMACEN = 4;
    public const RECEPCIONISTA = 5;
    public const JEFE_UNIDAD = 6;

    public const DIRECTOR_ADMINISTRATIVO = 7;



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
