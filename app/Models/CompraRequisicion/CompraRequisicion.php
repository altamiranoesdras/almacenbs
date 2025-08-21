<?php

namespace App\Models\CompraRequisicion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompraRequisicion extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisiciones';

    public $fillable = [
        'tipo_concurso_id',
        'ipo_adquisicion_id',
        'correlativo',
        'codigo',
        'codigo_consolidacion',
        'npg',
        'nog',
        'proveedor_adjudicado',
        'numero_adjudicacion',
        'estado_id',
        'subproductos',
        'partidas',
        'observaciones',
        'justificacion'
    ];

    protected $casts = [
        'codigo' => 'string',
        'codigo_consolidacion' => 'string',
        'npg' => 'string',
        'nog' => 'string',
        'numero_adjudicacion' => 'string',
        'subproductos' => 'string',
        'partidas' => 'string',
        'observaciones' => 'string',
        'justificacion' => 'string'
    ];

    public static $rules = [
        'tipo_concurso_id' => 'required',
        'ipo_adquisicion_id' => 'required',
        'correlativo' => 'nullable',
        'codigo' => 'required|string|max:20',
        'codigo_consolidacion' => 'nullable|string|max:45',
        'npg' => 'nullable|string|max:45',
        'nog' => 'nullable|string|max:45',
        'proveedor_adjudicado' => 'nullable',
        'numero_adjudicacion' => 'nullable|string|max:45',
        'estado_id' => 'required',
        'subproductos' => 'nullable|string|max:45',
        'partidas' => 'nullable|string|max:45',
        'observaciones' => 'nullable|string|max:65535',
        'justificacion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

//    public function ipoAdquisicion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(\App\Models\CompraRequisicionTipoAdquisicione::class, 'ipo_adquisicion_id');
//    }

    public function tipoConcurso(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicionTipoConcurso::class, 'tipo_concurso_id');
    }

//    public function proveedorAdjudicado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(\App\Models\Proveedore::class, 'proveedor_adjudicado');
//    }

//    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(\App\Models\CompraRequisicionEstado::class, 'estado_id');
//    }

//    public function compraOrdenes(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(\App\Models\CompraOrdene::class, 'gestion_id');
//    }

    public function compraRequisicionDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicionDetalle::class, 'requisicion_id');
    }

//    public function compraSolicitudes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(\App\Models\CompraSolicitude::class, 'compra_solicitud_has_requisicion');
//    }
}
