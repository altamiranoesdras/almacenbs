<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int|null $padre_id
 * @property string|null $nombre
 * @property string|null $codigo
 * @method static \Database\Factories\CostoCentroFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro query()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro wherePadreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CostoCentro withoutTrashed()
 * @mixin \Eloquent
 */
class CostoCentro extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'costo_centros';

    public $fillable = [
        'padre_id',
        'nombre',
        'codigo'
    ];

    protected $casts = [
        'nombre' => 'string',
        'codigo' => 'string'
    ];

    public static $rules = [
        'padre_id' => 'nullable',
        'nombre' => 'nullable|string|max:45',
        'codigo' => 'nullable|string|max:45'
    ];

    public static $messages = [

    ];

    public function rrhhUnidades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RrhhUnidade::class, 'centro_id');
    }
}
