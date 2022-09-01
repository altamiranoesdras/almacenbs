<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RrhhUnidad
 * @package App\Models
 * @version August 8, 2022, 12:14 am CST
 *
 * @property \App\Models\User $jefe
 * @property \Illuminate\Database\Eloquent\Collection $puestos
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property \Illuminate\Database\Eloquent\Collection $usuarios
 * @property string $nombre
 * @property integer $jefe_id
 * @property string $activa
 */
class RrhhUnidad extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_unidades';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'jefe_id',
        'activa'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'jefe_id' => 'integer',
        'activa' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'jefe_id' => 'nullable',
        'activa' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function jefe()
    {
        return $this->belongsTo(User::class, 'jefe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function puestos()
    {
        return $this->belongsToMany(RrhhPuesto::class, 'puesto_has_unidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usuarios()
    {
        return $this->hasMany(User::class, 'unidad_id');
    }
}
