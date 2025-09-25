<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedProduccionProyecto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_proyectos';

    public $fillable = [
        'red_produccion_sub_programa_id',
        'codigo',
        'nombre'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'red_produccion_sub_programa_id' => 'required',
        'codigo' => 'required|string|max:4',
        'nombre' => 'required|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function redProduccionSubPrograma(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionSubPrograma::class, 'red_produccion_sub_programa_id');
    }

    public function redProduccionProductos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionProducto::class, 'red_produccion_proyecto_id');
    }
}
