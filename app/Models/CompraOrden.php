<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraOrden extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_ordenes';

    public $fillable = [
        'gestion_id',
        'proveedor_id',
        'numero',
        'fecha',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'numero' => 'string',
        'fecha' => 'datetime',
        'estado' => 'string',
        'observaciones' => 'string'
    ];

    public static $rules = [
        'gestion_id' => 'required',
        'proveedor_id' => 'required',
        'numero' => 'required|string|max:50',
        'fecha' => 'required',
        'estado' => 'required|string',
        'observaciones' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function gestion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicione::class, 'gestion_id');
    }

    public function proveedor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Proveedore::class, 'proveedor_id');
    }

    public function compraOrdenDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraOrdenDetalle::class, 'orden_id');
    }
}
