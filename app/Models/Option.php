<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Option
 *
 * @property int $id
 * @property int|null $option_id opcion padre
 * @property string $nombre
 * @property string|null $ruta
 * @property string|null $descripcion
 * @property string $icono_l
 * @property string|null $icono_r
 * @property int|null $orden
 * @property string|null $color
 * @property int $recursos
 * @property bool $dev
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Option> $children
 * @property-read int|null $children_count
 * @property-read mixed $active
 * @property-read mixed $ruta_evaluada
 * @property-read mixed $text
 * @property-read mixed $visible_to_user
 * @property-read Option|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Option padres()
 * @method static \Illuminate\Database\Eloquent\Builder|Option padresDe($chidres)
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDev($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereIconoL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereIconoR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRecursos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRuta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Option withoutTrashed()
 * @mixin \Eloquent
 */
class Option extends Model
{

    use SoftDeletes;

    public $table = 'options';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public const PANEL_DE_CONTROL = 1;
    public const NUEVA_SOLICITUD_DE_COMPRA = 3;
    public const MIS_SOLICITUDES_DE_COMPRAS = 4;
    public const BUSCAR_SOLICITUD_DE_COMPRA = 5;
    public const CONSOLIDAR_SOLICITUDES = 6;
    public const NUEVO_INGRESO_ALMACEN = 8;
    public const PROVEEDORES = 9;
    public const BUSCAR_INGRESOS_A_ALMACEN = 10;
    public const NUEVA_REQUISICION_ALMACEN = 12;
    public const MIS_REQUISICIONES_ALMACEN = 13;
    public const AUTORIZAR_REQUISICION_ALMACEN = 14;
    public const DESPACHAR_REQUISICION_ALMACEN = 16;
    public const BUSCAR_REQUISICION_ALMACEN = 17;
    public const NUEVO_INSUMO = 20;
    public const BUSCAR_INSUMOS = 21;
    public const CATEGORIAS = 22;
    public const UNIDADES_DE_MEDIDA = 23;
    public const MARCAS = 24;
    public const IMPORTAR_EXCEL = 25;
    public const STOCK_CRITICO = 27;
    public const RENGLONES = 28;
    public const MAGNITUD_UM = 29;
    public const ACTIVOS_FIJOS = 31;
    public const TARJETA_DE_RESPONSABILIDAD = 32;
    public const INGRESO_DE_CODIGO_DE_INVENTARIO_1H = 33;
    public const SOLICITUD_DE_CARGO_O_DESCARGO_DE_BIENES = 34;
    public const REPORTE_BIENES_POR_UNIDAD = 35;
    public const IMPORTAR_EXCEL_2 = 36;
    public const UNIDADES_DEPENDENCIA = 38;
    public const MIS_CONSUMOS = 41;
    public const BUSCAR_CONSUMO = 42;
    public const NUEVO_CONSUMO = 43;
    public const MENU = 45;
    public const PRUEBA_APIS = 46;
    public const CONFIGURACIONES = 47;
    public const PERMISOS = 48;
    public const LOGS = 49;
    public const USUARIOS = 51;
    public const ROLES = 52;
    public const CONFIGURACIONES_2 = 53;
    public const STOCK = 55;
    public const KARDEX = 56;
    public const ARTICULOS_A_VENCER = 57;
    public const LIBRO_ALMACEN = 58;
    public const TIPO_ADQUISICION = 60;
    public const REQUISICION_COMPRA_ESTADOS = 61;
    public const TIPO_CONCURSOS_COMPRA = 62;
    public const SOLICITUD_COMPRA_ESTADOS = 63;
    public const COMPRA_BANDEJAS = 64;
    public const PRUEBA_DE_FIRMA_ELECTRONICA = 66;
    public const OPERAR_INGRESO_ALMACEN = 67;
    public const APROBAR_INGRESO_ALMACEN = 68;
    public const AUTORIZAR_INGRESO_ALMACEN = 69;
    public const APROBAR_REQUISICION_COMPRA = 71;
    public const AUTORIZAR_REQUISICION_COMPRA = 72;
    public const BUSCADOR_REQUISICIONES_COMPRA = 73;
    public const MIS_REQUISICIONES_COMPRA = 74;
    public const COMPRA_TIPO_PROCESO = 75;
    public const ENVIOS_FISCALES = 77;

    public const BANDEJA_SUPERVISOR_COMPRAS = 91;
    public const BANDEJA_ANALISTA_PRESUPUESTO = 92;
    public const BANDEJA_ANALISTA_COMPRAS = 93;





    protected $appends= ['active','visible_to_user','text','ruta_evaluada'];

    public $fillable = [
        'option_id',
        'nombre',
        'ruta',
        'descripcion',
        'icono_l',
        'icono_r',
        'orden',
        'color',
        'recursos',
        'dev'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'option_id' => 'integer',
        'nombre' => 'string',
        'ruta' => 'string',
        'descripcion' => 'string',
        'icono_l' => 'string',
        'icono_r' => 'string',
        'orden' => 'integer',
        'color' => 'string',
        'dev' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'ruta' => 'required',
        'icono_l' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'option_role');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'option_user');
    }

    public function parent()
    {
        return $this->belongsTo(Option::class,'option_id','id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Option::class,'option_id','id')->orderBy('orden')->with('children');
    }

    public function hasChildren()
    {
        return $this->children->count()>0;
    }

    public function hasTreeview()
    {
        return $this->hasChildren() ? 'has-treeview' : '';
    }

    public function active()
    {
        if (!$this->ruta){
            return '';
        }

        $tieneIndex = str_contains($this->ruta,'index');


        if ($this->recursos && $tieneIndex){
            $rutaCreate = str_replace("index","create",$this->ruta);
            $rutaEdit = str_replace("index","edit",$this->ruta);
            $rutasRecursos = [$this->ruta,$rutaCreate,$rutaEdit];

            $rutaActual = request()->route()->getName();

            return in_array($rutaActual,$rutasRecursos) ? 'active' : '';

        }else{
            return request()->routeIs($this->ruta)  ? 'active' : '';
        }

    }

    public function openTreeView($children=null)
    {

        return $this->allDescendant()->contains('active','active') ? 'menu-open' : '';

    }

    public function allDescendant($children=null,$all=null)
    {
        $all = $all ?? collect();

        $children = $children ?? $this->children;

        foreach ($children as $child){
            $all = $all->push($child);
            if ($child->children->count()>0){
                $this->allDescendant($child->children,$all);
            }
        }

        return $all;
    }

    public function getActiveAttribute()
    {
        return $this->active();
    }

    public function getVisibleToUserAttribute()
    {
        if (Auth::user()){

            return is_null($this->option_id) || Auth::user()->getAllOptions()->contains('id',$this->id);
        }

        return false;
    }

    public function scopePadres($query)
    {
        return $query->whereNull('options.option_id')->orderBy('orden');
    }

    public function scopePadresDe($query,$chidres)
    {
        return $query->whereHas('children',function ($q)use ($chidres){
            $q->whereIn('id',$chidres);
        });
    }

    public function isChildren()
    {
        return !is_null($this->option_id);
    }

    public function getTextAttribute()
    {
        return $this->nombre;
    }

    public function getRutaEvaluadaAttribute()
    {
        return rutaOpcion($this);
    }
}


