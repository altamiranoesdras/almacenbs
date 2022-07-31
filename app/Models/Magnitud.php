<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Magnitud
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $unimeds
 * @property string $nombre
 */
class Magnitud extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'magnitudes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



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
        'nombre' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function unimeds()
    {
        return $this->hasMany(\App\Models\Unimed::class, 'magnitud_id');
    }
}
