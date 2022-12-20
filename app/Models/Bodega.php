<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Bodega
 * @package App\Models
 * @version December 19, 2022, 11:01 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 */
class Bodega extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'bodegas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PRINCIPAL =           1;
    const SANTIAGO_ATITLAN =    2;
    const IXCHIGUÁN =           3;
    const NEBAJ =               4;
    const SANTA_EULALIA =       5;
    const PLAYA_GRANDE =        6;

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'direccion',
        'telefono'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'direccion' => 'string',
        'telefono' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'direccion' => 'nullable|string',
        'telefono' => 'nullable|string|max:30',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stocks()
    {
        return $this->hasMany(\App\Models\Stock::class, 'bodega_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'bodega_id');
    }
}
