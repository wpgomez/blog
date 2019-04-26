<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'url', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id'
    ];
    
    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'url';
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        $query->whereNotnull('published_at')
                ->where('published_at', '<=', Carbon::now())
                ->latest('published_at');
    }

    public function scopeAllowed($query)
    {
        if ( auth()->user()->hasRole('Admin') ) {
            return $query;
        }
            
        return $query->where('user_id', auth()->id());
    }

    public function syncTags($tags)
    {
        $tagsNew = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagsNew);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post){
            $post->tags()->detach();

            $post->photos->each->delete();
        });
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $post = static::query()->create($attributes);

        $post->generateUrl();

        return $post;
    }

    public function generateUrl()
    {
        $url = str_slug($this->title);
        if ($this->where('url', $url)->exists()) {
            $url = "{$url}-{$this->id}";
        }

        $this->url = $url;
        $this->save();
    }

    public function isPublished()
    {
        return (bool) $this->published_at && $this->published_at < today();
    }

    public function viewType($home = '')
    {
        if ($this->photos->count() === 1):
            return 'posts.photo';
        elseif($this->photos->count() > 1):
            return $home === 'home' ? 'posts.carousel-preview' : 'posts.carousel';
        elseif($this->iframe):
            return 'posts.iframe';
        else:
            return 'posts.text';
        endif;
    }
}
