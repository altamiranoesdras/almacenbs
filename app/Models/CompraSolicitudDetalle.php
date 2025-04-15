<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraSolicitudDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitud_detalles';

    public $fillable = [
        'solicitud_id',
        'item_id',
        'cantidad',
        'precio_venta',
        'precio_compra'
    ];

    protected $casts = [
        'precio_venta' => 'decimal:2',
        'precio_compra' => 'decimal:2'
    ];

    public static $rules = [
        'solicitud_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required',
        'precio_venta' => 'nullable|numeric',
        'precio_compra' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function solicitud(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraSolicitude::class, 'solicitud_id');
    }
}
