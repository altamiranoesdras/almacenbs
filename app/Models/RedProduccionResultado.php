<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedProduccionResultado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_resultados';

    public $fillable = [
        'codigo',
        'nombre',
        'descripcion'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function redProduccionProductos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionProducto::class, 'resultado_id');
    }

    public function estructuraPresupuestariaSubprogramas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\EstructuraPresupuestariaSubprograma::class, 'red_produccion_resultado_subprograma');
    }
}
