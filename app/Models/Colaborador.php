<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Colaborador
 * @package App\Models
 * @version November 10, 2022, 2:41 pm CST
 *
 * @property \App\Models\RrhhPuesto $puesto
 * @property \App\Models\User $user
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $solicitudOrigen
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDestino
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetas
 * @property \Illuminate\Database\Eloquent\Collection $contratos
 * @property \Illuminate\Database\Eloquent\Collection $jefe
 * @property string $nombres
 * @property string $apellidos
 * @property string $dpi
 * @property string $correo
 * @property string $telefono
 * @property string $direccion
 * @property string $nit
 * @property integer $puesto_id
 * @property integer $unidad_id
 * @property integer $user_id
 */
class Colaborador extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_colaboradores';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['text','nombre_completo'];

    public $fillable = [
        'nombres',
        'apellidos',
        'dpi',
        'correo',
        'telefono',
        'direccion',
        'nit',
        'puesto_id',
        'unidad_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string',
        'dpi' => 'string',
        'correo' => 'string',
        'telefono' => 'string',
        'direccion' => 'string',
        'nit' => 'string',
        'puesto_id' => 'integer',
        'unidad_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'dpi' => 'nullable|string|max:13',
        'correo' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:45',
        'direccion' => 'nullable|string',
        'nit' => 'nullable|string|max:10',
        'puesto_id' => 'required',
        'unidad_id' => 'required',
        'user_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function puesto()
    {
        return $this->belongsTo(\App\Models\RrhhPuesto::class, 'puesto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudOrigen()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'colaborador_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudDestino()
    {
        return $this->hasMany(\App\Models\ActivoSolicitud::class, 'colaborador_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoTarjetas()
    {
        return $this->hasMany(\App\Models\ActivoTarjeta::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contratos()
    {
        return $this->hasMany(\App\Models\RrhhContrato::class, 'colaborador_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function jefe()
    {
        return $this->hasMany(\App\Models\RrhhUnidad::class, 'jefe_id');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombres." ".$this->apellidos;
    }

    public function getTextAttribute()
    {
        return $this->nit." - ".$this->nombres." ".$this->apellidos." (".($this->unidad->nombre ?? null).")";
    }
}
