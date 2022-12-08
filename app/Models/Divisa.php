<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Divisa
 *
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 * @property string $simbolo
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\DivisaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa newQuery()
 * @method static \Illuminate\Database\Query\Builder|Divisa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Divisa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Divisa withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Divisa withoutTrashed()
 * @mixin \Eloquent
 */
class Divisa extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'divisas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
        'simbolo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'simbolo' => 'required|string|max:2',
        'nombre' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
