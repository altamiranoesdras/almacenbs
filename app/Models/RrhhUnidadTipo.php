<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property bool|null $nivel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\RrhhUnidadTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RrhhUnidadTipo withoutTrashed()
 * @mixin \Eloquent
 */
class RrhhUnidadTipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'rrhh_unidad_tipos';

    public $fillable = [
        'nombre',
        'nivel'
    ];

    protected $casts = [
        'nombre' => 'string',
        'nivel' => 'boolean'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'nivel' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function rrhhUnidades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RrhhUnidade::class, 'unidad_tipo_id');
    }
}
