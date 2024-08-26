<?php

namespace App\Models;

use App\Contracts\Services\ImagesServiceContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['path'];
    public function url(): Attribute
    {
        /** @var ImagesServiceContract $imagesServiceContract */
        $imagesServiceContract = app(ImagesServiceContract::class);
        return Attribute::get(fn () => $this->path ? $imagesServiceContract->url($this->path) : null);
    }
}
