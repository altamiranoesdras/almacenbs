<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $codigo_fuente
 * @property string|null $codigo_organismo
 * @property string|null $correlativo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\FinanciamientoFuentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereCodigoFuente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereCodigoOrganismo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuent withoutTrashed()
 * @mixin \Eloquent
 */
class FinanciamientoFuent extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'financiamiento_fuentes';

    public $fillable = [
        'codigo_fuente',
        'codigo_organismo',
        'correlativo',
        'nombre'
    ];

    protected $casts = [
        'codigo_fuente' => 'string',
        'codigo_organismo' => 'string',
        'correlativo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'codigo_fuente' => 'required|string|max:255',
        'codigo_organismo' => 'nullable|string|max:255',
        'correlativo' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    
}
