<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->paginate(5);

        return view('welcome', [
            'posts' => $posts,
            'title' => 'Publicaciones de la etiqueta - '. $tag->name,
        ]);
    }
}
