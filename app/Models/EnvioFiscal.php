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
        'numero_resolucion',
        'numero_gestion',
        'fecha_gestion',
        'correlativo_resolucion',
        'fecha_correlativo_resolucion',
        'serie_envio',
        'numero_envio',
        'fecha_envio',
        'correlativo_del',
        'correlativo_al',
        'correlativo_inicial',
        'correlativo_actual',
        'libro',
        'folio',
        'activo'
    ];

    protected $casts = [
        'nombre_tabla' => 'string',
        'numero_resolucion' => 'string',
        'numero_gestion' => 'string',
        'fecha_gestion' => 'date',
        'correlativo_resolucion' => 'string',
        'fecha_correlativo_resolucion' => 'date',
        'serie_envio' => 'string',
        'numero_envio' => 'string',
        'fecha_envio' => 'date',
        'libro' => 'string',
        'activo' => 'string'
    ];

    public static $rules = [
        'nombre_tabla' => 'required|string|max:255',
        'numero_resolucion' => 'nullable|string|max:255',
        'numero_gestion' => 'nullable|string|max:255',
        'fecha_gestion' => 'nullable',
        'correlativo_resolucion' => 'nullable|string|max:255',
        'fecha_correlativo_resolucion' => 'nullable',
        'serie_envio' => 'nullable|string|max:255',
        'numero_envio' => 'nullable|string|max:255',
        'fecha_envio' => 'nullable',
        'correlativo_del' => 'required',
        'correlativo_al' => 'required',
        'correlativo_inicial' => 'required',
        'correlativo_actual' => 'required',
        'libro' => 'nullable|string|max:255',
        'folio' => 'nullable',
        'activo' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    const COMPRA = 1;
    const SOLICITUD = 2;

    public static $messages = [

    ];

    public function compra1hs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'envio_fiscal_id');
    }

    public function solicitudes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Solicitude::class, 'envio_fiscal_id');
    }

    public function desactivar()
    {
        $this->activo = 'no';
        $this->save();
    }

    public function siguienteFolio()
    {
        // si se llega al final del rango desactiva el envio fiscal
        if($this->correlativo_actual >= $this->correlativo_al) {
            $this->desactivar();
        }else{
            $this->increment('correlativo_actual');
        }

        $this->save();

    }

    public function getNombreAttribute()
    {
        switch ($this->nombre_tabla) {
            case 'compras':
                return 'Formularios de 1H';
                break;
            case 'solicitudes':
                return 'Requisiciones almacén';
                break;
            default:
                return $this->nombre_tabla;
                break;
        }

    }
}
