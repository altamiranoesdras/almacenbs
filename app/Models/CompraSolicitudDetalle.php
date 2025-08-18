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
        'precio_estimado'
    ];

    protected $casts = [
        'precio_estimado' => 'decimal:2'
    ];

    public static $rules = [
        'solicitud_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required',
        'precio_estimado' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $mensajes =[
        'item_id.required' => 'El artículo es requerido',
        'cantidad.required' => 'La cantidad es requerida',
        'cantidad.integer' => 'La cantidad debe ser un entero',
        'precio_estimado.required' => 'El precio de compra es requerido',
        'precio_estimado.numeric' => 'El precio de compra debe ser un número',
    ];

    public function solicitud(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraSolicitud::class, 'solicitud_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function compraRequisicionDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicionDetalle::class, 'solicitud_detalle_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->cantidad * $this->precio_estimado;

    }
}
