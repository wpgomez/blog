<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['url'] = str_slug($value);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
