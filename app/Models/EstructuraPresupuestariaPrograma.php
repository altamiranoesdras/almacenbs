<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstructuraPresupuestariaPrograma extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'estructura_presupuestaria_programas';

    public $fillable = [
        'codigo',
        'nombre',
        'descripcion'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function estructuraPresupuestariaSubprogramas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\EstructuraPresupuestariaSubprograma::class, 'programa_id');
    }
}
