<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @package App\Models
 * @version August 6, 2022, 10:40 am CST
 * @property \App\Models\Bodega $bodega
 * @property \App\Models\RrhhPuesto $puesto
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $compra1hs
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property \Illuminate\Database\Eloquent\Collection $compra1s
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslados
 * @property \Illuminate\Database\Eloquent\Collection $kardexs
 * @property \Illuminate\Database\Eloquent\Collection $options
 * @property \Illuminate\Database\Eloquent\Collection $rrhhUnidade2s
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property \Illuminate\Database\Eloquent\Collection $solicitude3s
 * @property \Illuminate\Database\Eloquent\Collection $solicitude4s
 * @property \Illuminate\Database\Eloquent\Collection $solicitude5s
 * @property \Illuminate\Database\Eloquent\Collection $solicitude6s
 * @property \Illuminate\Database\Eloquent\Collection $stockIniciales
 * @property \App\Models\UserDespachaUser $userDespachaUser
 * @property \Illuminate\Database\Eloquent\Collection $userDespachaUser7s
 * @property \Illuminate\Database\Eloquent\Collection $option8s
 * @property string $username
 * @property string $name
 * @property string $nit
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property integer $unidad_id
 * @property integer $puesto_id
 * @property string $provider
 * @property string $provider_uid
 * @property string $remember_token
 * @property int $id
 * @property int|null $dpi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read int|null $compra1hs_count
 * @property-read int|null $compras_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Compra[] $comprasRecibe
 * @property-read int|null $compras_recibe_count
 * @property-read mixed $img
 * @property-read mixed $thumb
 * @property-read \App\Models\RrhhUnidad|null $jefeUnidad
 * @property-read int|null $kardexs_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Option[] $shortcuts
 * @property-read int|null $shortcuts_count
 * @property-read int|null $solicitudes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesAprueba
 * @property-read int|null $solicitudes_aprueba_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesAutoriza
 * @property-read int|null $solicitudes_autoriza_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesCrea
 * @property-read int|null $solicitudes_crea_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitud[] $solicitudesDespacha
 * @property-read int|null $solicitudes_despacha_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $usersDespacha
 * @property-read int|null $users_despacha_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $usersSolicita
 * @property-read int|null $users_solicita_count
 * @method static \Illuminate\Database\Eloquent\Builder|User admins()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User noClientes()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $items_traslados_count
 * @property-read int|null $stock_iniciales_count
 */
class User extends Authenticatable implements  HasMedia
{
    use HasApiTokens,Notifiable,InteractsWithMedia,HasRoles,SoftDeletes,HasFactory;

    public $table = 'users';

    const PRINCIPAL = 1;

    protected $with = ['options.children'];

    public $fillable = [
        'username',
        'name',
        'nit',
        'email',
        'email_verified_at',
        'password',
        'unidad_id',
        'puesto_id',
        'bodega_id',
        'provider',
        'provider_uid',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'name' => 'string',
        'nit' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'unidad_id' => 'integer',
        'puesto_id' => 'integer',
        'provider' => 'string',
        'provider_uid' => 'string',
        'remember_token' => 'string'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'username' => 'sometimes|required|max:255|unique:users',
        'email'    => 'nullable|email|max:255|unique:users',
        'password' => 'required|min:6',
        'email_verified_at' => 'nullable',
        'unidad_id' => 'nullable',
        'puesto_id' => 'nullable',
        'provider' => 'nullable|string|max:255',
        'provider_uid' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];




    //-----------RELACIONES--------------

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function puesto()
    {
        return $this->belongsTo(\App\Models\RrhhPuesto::class, 'puesto_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bodega()
    {
        return $this->belongsTo(\App\Models\Bodega::class, 'bodega_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compra1hs()
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'usuario_procesa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compras()
    {
        return $this->hasMany(\App\Models\Compra::class, 'usuario_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comprasRecibe()
    {
        return $this->hasMany(\App\Models\Compra::class, 'usuario_recibe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itemsTraslados()
    {
        return $this->hasMany(\App\Models\ItemTraslado::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function kardexs()
    {
        return $this->hasMany(\App\Models\Kardex::class, 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function options()
    {
        return $this->belongsToMany(\App\Models\Option::class, 'option_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function jefeUnidad()
    {
        return $this->hasOne(\App\Models\RrhhUnidad::class, 'jefe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudesDespacha()
    {
        return $this->hasMany(\App\Models\Solicitud::class, 'usuario_despacha');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(\App\Models\Solicitud::class, 'usuario_solicita');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudesCrea()
    {
        return $this->hasMany(\App\Models\Solicitud::class, 'usuario_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudesAutoriza()
    {
        return $this->hasMany(\App\Models\Solicitud::class, 'usuario_autoriza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudesAprueba()
    {
        return $this->hasMany(\App\Models\Solicitud::class, 'usuario_aprueba');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockIniciales()
    {
        return $this->hasMany(\App\Models\StockInicial::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usersDespacha(){
        return $this->belongsToMany(User::class, 'user_despacha_user','user_des', 'user_sol');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function usersSolicita(){
        return $this->belongsToMany(User::class, 'user_despacha_user','user_sol','user_des');
    }




    //-----------SCOPES--------------

    public function scopeNoClientes($query){
        return $query->whereHas('roles',function ($q){
            $q->where('id','!=',Role::CLIENTE);
        })->orWhereDoesntHave('roles');
    }

    public function scopeAdmins($query){
        return $query->role(Role::ADMIN);
    }




    //-----------MÉTODOS Y MUTADORES--------------

    public function getImgAttribute()
    {
        $media = $this->getMedia('avatars')->last();
        return $media ? $media->getUrl() : asset('dist/img/avatar5.png');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }

    public function getThumbAttribute()
    {
        $media = $this->getMedia('avatars')->last();
        return $media ? $media->getUrl('thumb') : asset('dist/img/avatar5.png');
    }

    public function shortcuts()
    {
        return $this->belongsToMany(Option::class,'user_shortcuts','user_id','option_id');
    }

    public function getAllOptions()
    {
        $opcionesDirectas = $this->options;

        $opcionesPorRol = collect();


        /**
         * @var Role $role
         */
        foreach ($this->roles as $index => $role) {
            $opcionesPorRol = $opcionesPorRol->merge($role->options);
        }

        $allOptions = $opcionesDirectas->merge($opcionesPorRol);


//        dd($this->id,$opcionesDirectas->toArray(),$opcionesPorRol->toArray(),$allOptions->toArray());

        return $allOptions;
    }


    public function isSuperAdmin(){

        return $this->hasRole(Role::SUPERADMIN);
    }

    public function isAdmin(){

        return $this->hasRole(Role::ADMIN);
    }

    public function isDev(){

        return $this->hasRole(Role::DEVELOPER);
    }


}
