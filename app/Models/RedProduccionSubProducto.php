<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedProduccionSubProducto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_sub_productos';

    public $fillable = [
        'red_produccion_producto_id',
        'codigo',
        'nombre'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'red_produccion_producto_id' => 'required',
        'codigo' => 'required|string|max:4',
        'nombre' => 'required|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function redProduccionProducto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionProducto::class, 'red_produccion_producto_id');
    }

    public function rrhhUnidades(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\RrhhUnidade::class, 'red_produccion_unidades');
    }
}
