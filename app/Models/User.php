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
 * @package App\Models
 * @version January 28, 2020, 1:44 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection options
 * @property string username
 * @property string name
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string thumb
 * @property string img
 * @property string provider
 * @property string provider_uid
 * @property string remember_token
 */
class User extends Authenticatable implements  MustVerifyEmail,HasMedia
{
    use HasApiTokens,Notifiable,InteractsWithMedia,HasRoles,SoftDeletes,HasFactory;

    const PRINCIPAL = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password','provider','provider_uid'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['options.children'];

    public function getImgAttribute()
    {
        $media = $this->getMedia('avatars')->last();
        return $media ? $media->getUrl() : asset('dist/img/avatar5.png');
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'username' => 'sometimes|required|max:255|unique:users',
        'email'    => 'sometimes|required|email|max:255|unique:users',
        'password' => 'required|min:6',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function options()
    {
        return $this->belongsToMany(\App\Models\Option::class, 'option_user');
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


    public function scopeNoClientes($query){
        return $query->whereHas('roles',function ($q){
            $q->where('id','!=',Role::CLIENTE);
        })->orWhereDoesntHave('roles');
    }

    public function scopeAdmins($query){
        return $query->role(Role::ADMIN);
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

    public function usersDespacha(){
        return $this->belongsToMany(User::class, 'user_despacha_user','user_des', 'user_sol');
    }

    public function usersSolicita(){
        return $this->belongsToMany(User::class, 'user_despacha_user','user_sol','user_des');
    }


    public function notificaciones()
    {
        return $this->hasMany(Notificacione::class,'user_id','id');
    }

    public function tiempoUltimaNotificacion($tipo=null)
    {
        $query = $this->notificaciones()
            ->orderBy('created_at','asc');

        if($tipo){
            $query->deTipo($tipo);
        }

        $notificacion = $query->first();

        if($notificacion){
            $fecha = new Date($notificacion->created_at);

            return $fecha->diffForHumans(Carbon::now(),1);
        }


        return '';
    }


}
