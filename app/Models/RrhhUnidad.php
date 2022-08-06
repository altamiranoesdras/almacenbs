<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RrhhUnidad
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property string $nombre
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
        'activa' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'activa' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(\App\Models\Solicitude::class, 'unidad_id');
    }

    public function usuarios()
    {
        return $this->hasMany(User::class,'unidad_id');
    }
}
