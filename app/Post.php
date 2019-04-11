<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'url', 'body', 'iframe', 'excerpt', 'published_at', 'category_id'
    ];
    
    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['url'] = str_slug($value);
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? Carbon::parse($value) : null;
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = Category::find($value)
                                                ? $value 
                                                : Category::create(['name' => $value])->id;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function scopePublished($query)
    {
        $query->whereNotnull('published_at')
                ->where('published_at', '<=', Carbon::now())
                ->latest('published_at');
    }

    public function syncTags($tags)
    {
        $tagsNew = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagsNew);
    }
}
