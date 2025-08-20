<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Denominacion
 *
 * @property int $id
 * @property string $monto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\DenominacionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereMonto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Denominacion withoutTrashed()
 * @mixin \Eloquent
 */
class Denominacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'denominaciones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'monto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'monto' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'monto' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
