<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RrhhContrato
 *
 * @package App\Models
 * @version December 8, 2022, 11:13 am CST
 * @property \App\Models\RrhhColaborador $colaborador
 * @property \App\Models\RrhhUnidad $unidad
 * @property \App\Models\RrhhPuesto $puesto
 * @property integer $colaborador_id
 * @property integer $unidad_id
 * @property integer $puesto_id
 * @property string $numero
 * @property string $inicio
 * @property string $fin
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\RrhhContratoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato newQuery()
 * @method static \Illuminate\Database\Query\Builder|RrhhContrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhContrato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|RrhhContrato withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RrhhContrato withoutTrashed()
 * @mixin Model
 */
class RrhhContrato extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_contratos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'colaborador_id',
        'unidad_id',
        'puesto_id',
        'numero',
        'inicio',
        'fin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'colaborador_id' => 'integer',
        'unidad_id' => 'integer',
        'puesto_id' => 'integer',
        'numero' => 'string',
        'inicio' => 'date',
        'fin' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'colaborador_id' => 'required',
        'unidad_id' => 'required',
        'puesto_id' => 'nullable',
        'numero' => 'required|string|max:255',
        'inicio' => 'required',
        'fin' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function colaborador()
    {
        return $this->belongsTo(\App\Models\RrhhColaborador::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function puesto()
    {
        return $this->belongsTo(\App\Models\RrhhPuesto::class, 'puesto_id');
    }
}
