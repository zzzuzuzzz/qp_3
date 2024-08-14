<?php

namespace App\Models;

use App\Contracts\HasTagsContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Car extends Model implements HasTagsContract
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'old_price', 'description', 'salon', 'kpp', 'year', 'color', 'is_new', 'engine_id', 'class_id', 'body_id'];

    public function carClass(): BelongsTo
    {
        return $this->belongsTo(CarClass::class, 'class_id');
    }

    public function engine(): BelongsTo
    {
        return $this->belongsTo(CarEngine::class);
    }
    public function body(): BelongsTo
    {
        return $this->belongsTo(CarBody::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
