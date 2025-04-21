<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property int|null $bodega_id
 * @property int|null $proveedor_id
 * @property int|null $unidad_id
 * @property int|null $correlativo
 * @property string|null $codigo
 * @property \Illuminate\Support\Carbon|null $fecha_requiere
 * @property string|null $observaciones
 * @property int $estado_id
 * @property int $usuario_solicita
 * @property int|null $usuario_aprueba
 * @property int|null $usuario_administra
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraSolicitudDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\CompraSolicitudEstado $estado
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read \App\Models\Proveedor|null $proveedor
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \App\Models\User|null $usuarioAdministra
 * @property-read \App\Models\User|null $usuarioAprueba
 * @property-read \App\Models\User $usuarioSolicita
 * @method static \Database\Factories\CompraSolicitudFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud noTemporal()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereBodegaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereFechaRequiere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioAdministra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioAprueba($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud whereUsuarioSolicita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitud withoutTrashed()
 * @mixin \Eloquent
 */
class CompraSolicitud extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitudes';

    public $fillable = [
        'bodega_id',
        'proveedor_id',
        'unidad_id',
        'correlativo',
        'codigo',
        'fecha_requiere',
        'observaciones',
        'estado_id',
        'usuario_solicita',
        'usuario_aprueba',
        'usuario_administra',
        'subproductos',
        'partidas'
    ];

    protected $casts = [
        'codigo' => 'string',
        'fecha_requiere' => 'date',
        'observaciones' => 'string',
//        'subproductos' => 'string',
//        'partidas' => 'string'
    ];

    public static $rules = [
        'bodega_id' => 'nullable',
        'proveedor_id' => 'nullable',
        'unidad_id' => 'nullable',
        'correlativo' => 'nullable',
        'codigo' => 'nullable|string|max:10',
        'fecha_requiere' => 'nullable',
        'observaciones' => 'nullable|string|max:65535',
        'estado_id' => 'required',
        'usuario_solicita' => 'required',
        'usuario_aprueba' => 'nullable',
        'usuario_administra' => 'nullable',
        'subproductos' => 'nullable|string|max:255',
        'partidas' => 'nullable|string|max:255',
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

    public function proveedor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Proveedor::class, 'proveedor_id');
    }

    public function unidad(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    public function usuarioAdministra(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_administra');
    }

    public function usuarioAprueba(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_aprueba');
    }

    public function usuarioSolicita(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_solicita');
    }

    public function detalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraSolicitudDetalle::class, 'solicitud_id');
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
