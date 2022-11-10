<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contrato
 * @package App\Models
 * @version November 10, 2022, 2:44 pm CST
 *
 * @property \App\Models\RrhhColaboradore $colaborador
 * @property \App\Models\RrhhUnidade $unidad
 * @property \App\Models\RrhhPuesto $puesto
 * @property integer $colaborador_id
 * @property integer $unidad_id
 * @property integer $puesto_id
 * @property string $numero
 * @property string $inicio
 * @property string $fin
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
        return $this->belongsTo(\App\Models\RrhhColaboradore::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidade::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function puesto()
    {
        return $this->belongsTo(\App\Models\RrhhPuesto::class, 'puesto_id');
    }
}
