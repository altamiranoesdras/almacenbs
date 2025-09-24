<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedProduccionUnidade extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_unidades';

    public $fillable = [
        'rrhh_unidades_id'
    ];

    protected $casts = [
        
    ];

    public static $rules = [
        'rrhh_unidades_id' => 'required'
    ];

    public static $messages = [

    ];

    public function redProduccionSubProductos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionSubProducto::class, 'red_produccion_sub_productos_id');
    }

    public function rrhhUnidades(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RrhhUnidade::class, 'rrhh_unidades_id');
    }
}
