<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'departamentos';

    public $fillable = [
        'codigo',
        'nombre',
        'region_id'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'region_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Regione::class, 'region_id');
    }

    public function municipios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Municipio::class, 'departamento_id');
    }
}
