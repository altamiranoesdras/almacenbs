<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedProduccionProducto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_productos';

    public $fillable = [
        'red_produccion_proyecto_id',
        'codigo',
        'nombre'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'red_produccion_proyecto_id' => 'required',
        'codigo' => 'required|string|max:4',
        'nombre' => 'required|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function redProduccionProyecto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionProyecto::class, 'red_produccion_proyecto_id');
    }

    public function redProduccionSubProductos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionSubProducto::class, 'red_produccion_producto_id');
    }
}
