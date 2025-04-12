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
 *
 * @package App\Models
 * @version November 11, 2022, 11:13 am CST
 * @property \App\Models\Renglone $renglon
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
 * @property number $valor_actual
 * @property number $valor_adquisicion
 * @property number $valor_contabilizado
 * @property string $fecha_registro
 * @property integer $tipo_id
 * @property integer $estado_id
 * @property integer $renglon_id
 * @property integer $detalle_1h_id
 * @property integer $entidad
 * @property integer $unidad_ejecutadora
 * @property integer $tipo_inventario
 * @property string $codigo_sicoin
 * @property integer $codigo_donacion
 * @property string $nit
 * @property string $numero_documento
 * @property string $fecha_aprobado
 * @property string $fecha_contabilizacion
 * @property string $cur
 * @property string $contabilizado
 * @property integer $diferencia_act_adq
 * @property integer $diferencia_act_cont
 * @property integer $diferencia_adq_cont
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $img
 * @property-read mixed $thumb
 * @property-read int|null $items_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read int|null $solicitud_detalles_count
 * @property-read int|null $tarjeta_detalles_count
 * @method static \Database\Factories\ActivoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo newQuery()
 * @method static \Illuminate\Database\Query\Builder|Activo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCodigoDonacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCodigoInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCodigoSicoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereContabilizado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereCur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDetalle1hId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDiferenciaActAdq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDiferenciaActCont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereDiferenciaAdqCont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereEntidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaAprobado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaContabilizacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereNumeroDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereRenglonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereTipoInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereUnidadEjecutadora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereValorActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereValorAdquisicion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activo whereValorContabilizado($value)
 * @method static \Illuminate\Database\Query\Builder|Activo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Activo withoutTrashed()
 * @mixin \Eloquent
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
        'valor_actual',
        'valor_adquisicion',
        'valor_contabilizado',
        'fecha_registro',
        'tipo_id',
        'estado_id',
        'renglon_id',
        'detalle_1h_id',
        'entidad',
        'unidad_ejecutadora',
        'tipo_inventario',
        'codigo_sicoin',
        'codigo_donacion',
        'nit',
        'numero_documento',
        'fecha_aprobado',
        'fecha_contabilizacion',
        'cur',
        'contabilizado',
        'diferencia_act_adq',
        'diferencia_act_cont',
        'diferencia_adq_cont'
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
        'valor_actual' => 'decimal:2',
        'valor_adquisicion' => 'decimal:2',
        'valor_contabilizado' => 'decimal:2',
        'fecha_registro' => 'date',
        'tipo_id' => 'integer',
        'estado_id' => 'integer',
        'renglon_id' => 'integer',
        'detalle_1h_id' => 'integer',
        'entidad' => 'integer',
        'unidad_ejecutadora' => 'integer',
        'tipo_inventario' => 'integer',
        'codigo_sicoin' => 'string',
        'codigo_donacion' => 'integer',
        'nit' => 'string',
        'numero_documento' => 'string',
        'fecha_aprobado' => 'date',
        'fecha_contabilizacion' => 'date',
        'cur' => 'string',
        'contabilizado' => 'string',
        'diferencia_act_adq' => 'integer',
        'diferencia_act_cont' => 'integer',
        'diferencia_adq_cont' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'nullable|string|max:255',
        'descripcion' => 'required|string',
        'codigo_inventario' => 'required|string|max:100',
        'folio' => 'nullable|string|max:100',
        'valor_actual' => 'nullable|numeric',
        'valor_adquisicion' => 'nullable|numeric',
        'valor_contabilizado' => 'nullable|numeric',
        'fecha_registro' => 'nullable',
        'tipo_id' => 'required',
        'estado_id' => 'required',
        'renglon_id' => 'nullable',
        'detalle_1h_id' => 'nullable',
        'entidad' => 'nullable|integer',
        'unidad_ejecutadora' => 'nullable|integer',
        'tipo_inventario' => 'nullable|integer',
        'codigo_sicoin' => 'nullable|string|max:255',
        'codigo_donacion' => 'nullable|integer',
        'nit' => 'nullable|string|max:255',
        'numero_documento' => 'nullable|string|max:255',
        'fecha_aprobado' => 'nullable',
        'fecha_contabilizacion' => 'nullable',
        'cur' => 'nullable|string|max:255',
        'contabilizado' => 'nullable|string|max:255',
        'diferencia_act_adq' => 'nullable|integer',
        'diferencia_act_cont' => 'nullable|integer',
        'diferencia_adq_cont' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function renglon()
    {
        return $this->belongsTo(\App\Models\Renglon::class, 'renglon_id');
    }

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
