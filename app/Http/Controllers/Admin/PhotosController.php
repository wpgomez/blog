<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|image|max:2048',
        ]);

        $photo = $request->file('photo');

        return request()->all();
    }
}
