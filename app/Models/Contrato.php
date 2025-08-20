<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contrato
 *
 * @property int $id
 * @property int $colaborador_id
 * @property int $unidad_id
 * @property int|null $puesto_id
 * @property string $numero
 * @property \Illuminate\Support\Carbon $inicio
 * @property \Illuminate\Support\Carbon|null $fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\RrhhColaborador $colaborador
 * @property-read \App\Models\RrhhPuesto|null $puesto
 * @property-read \App\Models\RrhhUnidad $unidad
 * @method static \Database\Factories\ContratoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereColaboradorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato withoutTrashed()
 * @mixin Model
 */
class Contrato extends Model
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
        'puesto_id' => 'required',
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
