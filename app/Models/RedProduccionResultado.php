<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedProduccionResultado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_resultados';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function redProduccionProgramas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionPrograma::class, 'red_produccion_resultado_id');
    }
}
