<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RrhhUnidad
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int|null $centro_id
 * @property int $unidad_tipo_id
 * @property int|null $unidad_padre_id
 * @property int|null $jefe_id
 * @property int|null $departamento_id
 * @property int|null $municipio_id
 * @property string $activa
 * @property string $solicita
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read \Illuminate\Database\Eloquent\Collection<int, RrhhUnidad> $children
 * @property-read int|null $children_count
 * @property-read mixed $nombre_con_padre
 * @property-read mixed $nombre_con_padres
 * @property-read string $text
 * @property-read \App\Models\User|null $jefe
 * @property-read RrhhUnidad|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhPuesto> $puestos
 * @property-read int|null $puestos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RedProduccionSubProducto> $subProductos
 * @property-read int|null $sub_productos_count
 * @property-read \App\Models\RrhhUnidadTipo $tipo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuarios
 * @property-read int|null $usuarios_count
 * @method static Builder|RrhhUnidad areas()
 * @method static Builder|RrhhUnidad conStock()
 * @method static \Database\Factories\RrhhUnidadFactory factory($count = null, $state = [])
 * @method static Builder|RrhhUnidad newModelQuery()
 * @method static Builder|RrhhUnidad newQuery()
 * @method static Builder|RrhhUnidad onlyTrashed()
 * @method static Builder|RrhhUnidad padres()
 * @method static Builder|RrhhUnidad query()
 * @method static Builder|RrhhUnidad solicitan()
 * @method static Builder|RrhhUnidad whereActiva($value)
 * @method static Builder|RrhhUnidad whereCentroId($value)
 * @method static Builder|RrhhUnidad whereCodigo($value)
 * @method static Builder|RrhhUnidad whereCreatedAt($value)
 * @method static Builder|RrhhUnidad whereDeletedAt($value)
 * @method static Builder|RrhhUnidad whereDepartamentoId($value)
 * @method static Builder|RrhhUnidad whereId($value)
 * @method static Builder|RrhhUnidad whereJefeId($value)
 * @method static Builder|RrhhUnidad whereMunicipioId($value)
 * @method static Builder|RrhhUnidad whereNombre($value)
 * @method static Builder|RrhhUnidad whereSolicita($value)
 * @method static Builder|RrhhUnidad whereUnidadPadreId($value)
 * @method static Builder|RrhhUnidad whereUnidadTipoId($value)
 * @method static Builder|RrhhUnidad whereUpdatedAt($value)
 * @method static Builder|RrhhUnidad withTrashed()
 * @method static Builder|RrhhUnidad withoutAppends()
 * @method static Builder|RrhhUnidad withoutTrashed()
 * @mixin \Eloquent
 */
class RrhhUnidad extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'rrhh_unidades';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PRINCIPAL = 1;
    const ALMACEN = 31;

    const DEPTO_COMPRAS = 27;

    const DEPTO_PRESUPUESTOS = 37;


    protected static function booted(): void
    {

        // Después de crear: crear bodega por defecto
        static::created(function (RrhhUnidad $unidad) {
            $unidad->crearBodega();
        });

        // Después de actualizar: sincronizar algunos datos con la bodega
        static::saving(function (RrhhUnidad $unidad) {
            $unidad->crearBodega();
        });
    }



    protected $dates = ['deleted_at'];

    protected $appends = ['text', 'nombre_con_padre'];

    protected $with = ['tipo', 'parent'];

    public $fillable = [
        'nombre',
        'codigo',
        'unidad_tipo_id',
        'unidad_padre_id',
        'jefe_id',
        'departamento_id',
        'municipio_id',
        'activa',
        'solicita',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'jefe_id' => 'integer',
        'activa' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'jefe_id' => 'integer|exists:users,id',
        'departamento_id' => 'integer|exists:departamentos,id',
        'municipio_id' => 'integer|exists:municipios,id',
        'codigo' => 'required|string|max:255|unique:rrhh_unidades,codigo',
        'unidad_tipo_id' => 'required|integer|exists:rrhh_unidad_tipos,id',
        'activa' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }

    protected function getArrayableAppends()
    {
        if (self::$withoutAppends) {
            return [];
        }

        return parent::getArrayableAppends();
    }

    /**
     * @return BelongsTo
     **/
    public function jefe()
    {
        return $this->belongsTo(User::class, 'jefe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function puestos()
    {
        return $this->belongsToMany(RrhhPuesto::class, 'puesto_has_unidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usuarios()
    {
        return $this->hasMany(User::class, 'unidad_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(RrhhUnidad::class, 'unidad_padre_id', 'id')
            ->with('parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(RrhhUnidad::class, 'unidad_padre_id', 'id')
            ->with('children');
    }

    public function scopePadres($query)
    {
        return $query->whereNull('rrhh_unidades.unidad_padre_id');
    }

    public function isChildren(): bool
    {
        return !is_null($this->option_id);
    }

    public function hasChildren(): bool
    {
        return $this->children->count() > 0;
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(RrhhUnidadTipo::class, 'unidad_tipo_id');

    }

    public function getTextAttribute(): string
    {
        return $this->codigo . ' - ' . $this->nombre . ' (' . $this->tipo->nombre . ')';

    }

    public function getNombreConPadresAttribute()
    {

        return $this->nombreConPadres() . ' (' . $this->tipo->nombre . ')';

    }

    public function nombreConPadres()
    {
        if ($this->parent) {
            return $this->parent->nombreConPadres() . ' > ' . $this->nombre;
        }
        return $this->nombre;

    }

    public function getNombreConPadreAttribute()
    {
        if ($this->parent) {
            return $this->parent->nombre . ' > ' . $this->text;
        }
        return $this->text;

    }

    public function scopeAreas($query)
    {
        return $query->where('unidad_tipo_id', RrhhUnidadTipo::AREA);
    }

    public function scopeSolicitan($query)
    {
        return $query->where('solicita', 'si');
    }

    /**
     * busca el padre de un tipo determinado
     * si no lo encuentra, devuelve null
     * si no sé específica tipo, busca la dirección
     */
    public function buscarPadre(int $tipoId = RrhhUnidadTipo::DIRECCION): ?RrhhUnidad
    {
        //si no tiene padre, no hay dirección
        if (!$this->parent) {
            return null;
        }
        //si el padre es del tipo buscado, devolverlo
        if ($this->parent->unidad_tipo_id == $tipoId) {
            return $this->parent;
        }
        //si no, seguir buscando hacia arriba
        return $this->parent->buscarPadre($tipoId);
    }

    public function departamentoPadre(): ?RrhhUnidad
    {
        return $this->buscarPadre(RrhhUnidadTipo::DEPARTAMENTO);
    }

    public function direccionPadre(): ?RrhhUnidad
    {
        return $this->buscarPadre();
    }

    public function grupoPadre(): ?RrhhUnidad
    {
        return $this->buscarPadre(RrhhUnidadTipo::GRUPO);
    }

    public function subsecretariaPadre(): ?RrhhUnidad
    {
        return $this->buscarPadre(RrhhUnidadTipo::SUBSECRETARIA);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'unidad_id');
    }

    public function scopeConStock()
    {
        return $this->whereHas('stocks');

    }

    public function bodega(): HasOne|Builder|RrhhUnidad
    {
        return $this->hasOne(Bodega::class, 'rrhh_unidade_id', 'id');
    }

    public function subProductos()
    {
        return $this->belongsToMany(
            RedProduccionSubProducto::class,
            'red_produccion_subproducto_rrhh_unidad',
        'rrhh_unidad_id',
        'subproducto_id'
        );

    }

    public function esArea()
    {
        return $this->unidad_tipo_id == RrhhUnidadTipo::AREA;
    }

    public function crearBodega()
    {
        // si ya tiene bodega, no hacer nada
        if ($this->bodega) {
            return;
        }

        if ($this->esArea() && $this->solicita == 'si') {

            $this->bodega()->create([
                'nombre' => 'Bodega ' . $this->nombre,
            ]);
        }

    }

}
