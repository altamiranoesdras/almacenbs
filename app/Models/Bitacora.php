<?php

namespace App\Models;

use App\Mail\BaseEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Mail;

/**
 * Class Bitacora
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $seccion
 * @property string $titulo
 * @property string $comentario
 * @property int $usuario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $fecha_crea
 * @property-read Model|\Eloquent $model
 * @property-read \App\Models\User|null $usuario
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usuariosNotificar
 * @property-read int|null $usuarios_notificar_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereSeccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bitacora whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Bitacora extends Model
{

    protected $table = 'bitacoras';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    protected $appends = ['fecha_crea'];

    public $fillable = [
        'model_type',
        'model_id',
        'seccion',
        'titulo',
        'comentario',
        'notificado',
        'usuario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'model_type' => 'string',
        'model_id' => 'integer',
        'seccion' => 'string',
        'titulo' => 'string',
        'comentario' => 'string',
        'usuario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'model_type' => 'required',
        'model_id' => 'required',
        'titulo' => 'required',
        'comentario' => 'required',
//        'usuario_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function usuariosNotificar()
    {
        return $this->belongsToMany(\App\Models\User::class, 'bitacora_user_notifica','bitacora_id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }

    public function getFechaCreaAttribute()
    {
        return $this->created_at->format('d/m/Y h:i:s a');
    }


    public function notificar($usuarios=null,$link=null)
    {

        $usuarios = $this->usuariosNotificar ?? $usuarios;

        $correos = $usuarios->where('email','!=',null)->pluck('email')->toArray();


        $this->notificado++;
        $this->save();

        $data = [
            'titulo' => 'Funciones y Tareas',
            'nombre_modulo' => $this->titulo,
            'mensaje' => $this->comentario,
            'link' => $link ?? null,
        ];



        Mail::to($correos)->send(new BaseEmail($data));
    }
}
