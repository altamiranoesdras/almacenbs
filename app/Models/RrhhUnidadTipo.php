<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

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
