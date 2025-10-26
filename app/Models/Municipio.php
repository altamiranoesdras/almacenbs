<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int|null $departamento_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Departamento|null $departamento
 * @method static \Database\Factories\MunicipioFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereDepartamentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipio withoutTrashed()
 * @mixin \Eloquent
 */
class Municipio extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'municipios';

    protected $appends = [
        'texto'
    ];

    public $fillable = [
        'codigo',
        'nombre',
        'departamento_id'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'departamento_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function departamento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Departamento::class, 'departamento_id');
    }

    public function getTextoAttributo()
    {
        return $this->codigo . ' - ' . $this->nombre;
    }
}
