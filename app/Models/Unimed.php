<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Unimed
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 *
 * @property \App\Models\Magnitude $magnitude
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property integer $magnitude_id
 * @property string $simbolo
 * @property string $nombre
 */
class Unimed extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'unimeds';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'magnitude_id',
        'simbolo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'magnitude_id' => 'integer',
        'simbolo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'magnitude_id' => 'required',
        'simbolo' => 'required|string|max:10',
        'nombre' => 'required|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function magnitude()
    {
        return $this->belongsTo(\App\Models\Magnitude::class, 'magnitude_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class, 'unimed_id');
    }
}
