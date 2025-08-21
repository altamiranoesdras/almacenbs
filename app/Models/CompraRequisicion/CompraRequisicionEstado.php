<?php

namespace App\Models\CompraRequisicion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompraRequisicionEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_estados';

    public $fillable = [
        'nombre',
        'tipo_proceso'
    ];

    protected $casts = [
        'nombre' => 'string',
        'tipo_proceso' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'tipo_proceso' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraBandejas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraBandeja::class, 'compra_estado_has_bandeja');
    }

    public function compraRequisiciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicione::class, 'estado_id');
    }
}
