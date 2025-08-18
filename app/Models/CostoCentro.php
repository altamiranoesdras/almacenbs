<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostoCentro extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'costo_centros';

    public $fillable = [
        'padre_id',
        'nombre',
        'codigo'
    ];

    protected $casts = [
        'nombre' => 'string',
        'codigo' => 'string'
    ];

    public static $rules = [
        'padre_id' => 'nullable',
        'nombre' => 'nullable|string|max:45',
        'codigo' => 'nullable|string|max:45'
    ];

    public static $messages = [

    ];

    public function rrhhUnidades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RrhhUnidade::class, 'centro_id');
    }
}
