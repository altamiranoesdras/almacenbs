<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnvioFiscal extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'envios_fiscales';

    public $fillable = [
        'nombre_tabla',
        'correlativo_del',
        'correlativo_al',
        'folio_inicial',
        'folio_actual',
        'nuemero_constancia',
        'serie_constancia',
        'fecha',
        'numero_cuenta',
        'forma',
        'serie',
        'numero',
        'libro',
        'folio',
        'resolucion',
        'numero_gestion',
        'fecha_gestion',
        'correlativo',
        'activo'
    ];

    protected $casts = [
        'nombre_tabla' => 'string',
        'serie_constancia' => 'string',
        'fecha' => 'date',
        'numero_cuenta' => 'string',
        'forma' => 'string',
        'serie' => 'string',
        'numero' => 'string',
        'libro' => 'string',
        'resolucion' => 'string',
        'numero_gestion' => 'string',
        'fecha_gestion' => 'date',
        'correlativo' => 'string',
        'activo' => 'string'
    ];

    public static $rules = [
        'nombre_tabla' => 'required|string|max:255',
        'correlativo_del' => 'required',
        'correlativo_al' => 'required',
        'folio_inicial' => 'required',
        'folio_actual' => 'required',
        'nuemero_constancia' => 'nullable',
        'serie_constancia' => 'nullable|string|max:255',
        'fecha' => 'nullable',
        'numero_cuenta' => 'nullable|string|max:255',
        'forma' => 'nullable|string|max:255',
        'serie' => 'nullable|string|max:255',
        'numero' => 'nullable|string|max:255',
        'libro' => 'nullable|string|max:255',
        'folio' => 'nullable',
        'resolucion' => 'nullable|string|max:255',
        'numero_gestion' => 'nullable|string|max:255',
        'fecha_gestion' => 'nullable',
        'correlativo' => 'nullable|string|max:255',
        'activo' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compra1hs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'envio_fiscal_id');
    }
}
