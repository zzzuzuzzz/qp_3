<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Contracts\HasTagsContract;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Article extends Model implements HasTagsContract
{
    use HasFactory;
    protected $fillable = ['slug', 'title', 'description', 'body', 'published_at', 'image_id'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
    public function imageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->image?->url ?: '/assets/images/no_image.png');
    }
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
