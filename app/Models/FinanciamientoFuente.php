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
 * @property-read string $texto
 * @method static \Database\Factories\FinanciamientoFuenteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereCodigoFuente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereCodigoOrganismo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanciamientoFuente withoutTrashed()
 * @mixin \Eloquent
 */
class FinanciamientoFuente extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'financiamiento_fuentes';

    protected $appends = ['texto'];

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

    public function getTextoAttribute(): string
    {
        return $this->codigo_fuente . ' - ' . $this->nombre;
    }

}
