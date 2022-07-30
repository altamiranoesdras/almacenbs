<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Renglon
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property integer $numero
 * @property string $descripcion
 */
class Renglon extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'renglones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $appends = ['text'];

    public $fillable = [
        'numero',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numero' => 'integer',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numero' => 'nullable|integer',
        'descripcion' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class, 'renglon_id');
    }

    public function getTextAttribute()
    {
        return $this->numero." - ".str_limit($this->descripcion,50);
    }
}
