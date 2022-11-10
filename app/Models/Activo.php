<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Activo
 * @package App\Models
 * @version September 4, 2022, 8:11 pm CST
 *
 * @property \App\Models\ActivoEstado $estado
 * @property \App\Models\Compra1hDetalle $detalle1h
 * @property \App\Models\ActivoTipo $tipo
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $tarjetaDetalles
 * @property string $nombre
 * @property string $descripcion
 * @property string $codigo_inventario
 * @property string $folio
 * @property number $valor
 * @property string $fecha_registra
 * @property integer $tipo_id
 * @property integer $detalle_1h_id
 * @property integer $estado_id
 * @property string $thumb
 */
class Activo extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia;

    use HasFactory;

    public $table = 'activos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $with = ['media'];
    protected $appends = ['img','thumb'];



    public $fillable = [
        'nombre',
        'descripcion',
        'codigo_inventario',
        'folio',
        'valor',
        'fecha_registra',
        'tipo_id',
        'detalle_1h_id',
        'estado_id',
        'entidad',
        'unidad_ejecutadora',
        'renglon_id',
        'tipo_inventario',
        'codigo_sicoin',
        'valor_actual',
        'valor_adquisicion',
        'valor_contabilizado',
        'codigo_donacion',
        'nit',
        'numero_documento',
        'fecha_registro',
        'fecha_aprobado',
        'fecha_contabilizacion',
        'cur',
        'contabilizado',
        'diferencia_act_adq',
        'diferencia_act_cont',
        'diferencia_adq_cont',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'codigo_inventario' => 'string',
        'folio' => 'string',
        'valor' => 'decimal:2',
//        'fecha_registra' => 'date:Y-m-d',
        'tipo_id' => 'integer',
        'detalle_1h_id' => 'integer',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'codigo_inventario' => 'required|string|max:100',
        'folio' => 'nullable|string|max:100',
        'valor' => 'nullable|numeric',
        'fecha_registra' => 'required',
        'tipo_id' => 'required',
        'detalle_1h_id' => 'nullable',
        'estado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ActivoEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function detalle1h()
    {
        return $this->belongsTo(\App\Models\Compra1hDetalle::class, 'detalle_1h_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\ActivoTipo::class, 'tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function items()
    {
        return $this->belongsToMany(\App\Models\Item::class, 'activo_item');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudDetalles()
    {
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'activo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tarjetaDetalles()
    {
        return $this->hasMany(\App\Models\ActivoTarjetaDetalle::class, 'activo_id');
    }

    public function getImgAttribute()
    {
        $media = $this->getMedia('activos')->last();
        return $media ? $media->getUrl() : asset('img/default.svg');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(270)
            ->height(270);
    }

    public function getThumbAttribute()
    {
        $media = $this->getMedia('activos')->last();
        return $media ? $media->getUrl('thumb') : asset('img/default.svg');
    }
}
