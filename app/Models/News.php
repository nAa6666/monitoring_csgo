<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasSlug;
    protected $fillable = [
        'title', 'meta_title', 'description',
        'meta_description', 'meta_keywords', 'slug'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}
