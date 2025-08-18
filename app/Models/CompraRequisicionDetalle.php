<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraRequisicionDetalle extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_detalles';

    public $fillable = [
        'requisicion_id',
        'solicitud_detalle_id',
        'item_id',
        'cantidad',
        'precio_estimado',
        'observaciones'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'precio_estimado' => 'decimal:2',
        'observaciones' => 'string'
    ];

    public static $rules = [
        'requisicion_id' => 'required',
        'solicitud_detalle_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio_estimado' => 'required|numeric',
        'observaciones' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function requisicion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicione::class, 'requisicion_id');
    }

    public function solicitudDetalle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraSolicitudDetalle::class, 'solicitud_detalle_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }
}
