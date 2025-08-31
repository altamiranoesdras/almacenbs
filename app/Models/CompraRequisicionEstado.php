<?php

namespace App\Models;

use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompraRequisicionEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_estados';

    // Estados generales
    const CREADA                                = 1;
    const REQUERIDA                              = 2;
    const APROBADA                               = 3;
    const AUTORIZADA                             = 4;
    const ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS    = 5;
    const ASIGNADA_A_ANALISTA_DE_COMPRAS         = 6;
    const INICIO_DE_GESTION                      = 7;
    const EN_PROCESO_DE_GESTION                  = 8;
    const ENVIADA_A_PROVEEDORES                  = 9;
    const EN_ESPERA_DE_RESPUESTA_DE_PROVEEDORES  = 10;
    const CUADRO_COMPARATIVO_GENERADO            = 11;
    const ACTA_NEGOCIACION_GENERADA              = 12;
    const ACTA_NEGOCIACION_AUTORIZADA            = 13;
    const ADJUDICADA                             = 14;
    const ORDEN_DE_COMPRA_GENERADA               = 15;
    const FINALIZADA                             = 16;
    const CANCELADA                              = 17;


    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraBandejas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraBandeja::class, 'compra_has_bandeja');
    }

    public function requisicion(): HasMany
    {
        return $this->hasMany(CompraRequisicion::class, 'id');
    }

    public function getColorAttribute(): string
    {
        switch ($this->id) {
            case self::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS:
            case self::ASIGNADA_A_ANALISTA_DE_COMPRAS:
            case self::CUADRO_COMPARATIVO_GENERADO:
            case self::ACTA_NEGOCIACION_GENERADA:
            case self::REQUERIDA:
                return 'info';
            case self::AUTORIZADA:
            case self::INICIO_DE_GESTION:
            case self::EN_PROCESO_DE_GESTION:
            case self::ACTA_NEGOCIACION_AUTORIZADA:
            case self::APROBADA:
                return 'primary';
            case self::EN_ESPERA_DE_RESPUESTA_DE_PROVEEDORES:
            case self::ENVIADA_A_PROVEEDORES:
                return 'warning';
            case self::ORDEN_DE_COMPRA_GENERADA:
            case self::FINALIZADA:
            case self::ADJUDICADA:
                return 'success';
            case self::CANCELADA:
                return 'danger';
            case self::CREADA:
            default:
                return 'secondary';
        }
    }

}
