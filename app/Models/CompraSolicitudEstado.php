<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\CompraSolicitudEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado withoutTrashed()
 * @mixin \Eloquent
 */
class CompraSolicitudEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitud_estados';


    const TEMPORAL =    1;

    const INGRESADA =   2;
    const PROCESADA =   3;

    const RESERVADA =   4;

    const ANULADA =     5;

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
