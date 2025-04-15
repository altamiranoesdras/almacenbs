<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraSolicitudEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitud_estados';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:50',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraSolicitudes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraSolicitude::class, 'estado_id');
    }
}
