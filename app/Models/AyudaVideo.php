<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property string $titulo
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $video
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\AyudaVideoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AyudaVideo withoutTrashed()
 * @mixin \Eloquent
 */
class AyudaVideo extends Model implements HasMedia
{

    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;

    public $table = 'ayuda_videos';

    public $fillable = [
        'titulo',
        'descripcion'
    ];

    protected $casts = [
        'titulo' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->width(640)
            ->height(360)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('full')
            ->width(1280)
            ->height(720)
            ->sharpen(10)
            ->nonQueued();

    }

    public function getVideoAttribute()
    {
        $media = $this->getMedia('videos')->first();
        if ($media) {
            return $media->getUrl();
        }
        return null;

    }


}
