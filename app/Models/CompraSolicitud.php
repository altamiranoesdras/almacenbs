<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraSolicitud extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitudes';

    public $fillable = [
        'bodega_id',
        'unidad_id',
        'correlativo',
        'codigo',
        'fecha_solicita',
        'justificacion',
        'estado_id',
        'usuario_solicita',
        'usuario_verifica'
    ];

    protected $casts = [
        'codigo' => 'string',
        'fecha_solicita' => 'date',
        'justificacion' => 'string'
    ];

    public static $rules = [
        'bodega_id' => 'nullable',
        'unidad_id' => 'nullable',
        'correlativo' => 'nullable',
        'codigo' => 'nullable|string|max:10',
        'fecha_solicita' => 'nullable',
        'justificacion' => 'nullable|string|max:65535',
        'estado_id' => 'required',
        'usuario_solicita' => 'required',
        'usuario_verifica' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function bodega(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Bodega::class, 'bodega_id');
    }

    public function estado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraSolicitudEstado::class, 'estado_id');
    }

    public function unidad(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    public function usuarioVerifica(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_verifica');
    }

    public function usuarioSolicita(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_solicita');
    }

    public function detalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraSolicitudDetalle::class, 'solicitud_id');
    }

    public function compraRequisiciones(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraRequisicion::class, 'compra_solicitud_has_requisicion');
    }

    public function scopeNoTemporal($q)
    {
        return $q->where('estado_id', '!=', CompraSolicitudEstado::TEMPORAL);
    }

    public function getSubTotalAttribute()
    {
        return $this->total;

    }


    public function getTotalAttribute()
    {

        return $this->detalles->sum(function (CompraSolicitudDetalle $det){
            return $det->cantidad*$det->precio_compra;
        });
    }


    public function puedeEditar()
    {
        return in_array($this->estado_id,[
            CompraSolicitudEstado::TEMPORAL,
            CompraSolicitudEstado::INGRESADA
        ]);

    }

    public function esTemporal()
    {
        return $this->estado_id == CompraSolicitudEstado::TEMPORAL;

    }
}
