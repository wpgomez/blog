<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|min:3']);

        $post = Post::create([
            'title' => $request->get('title'),
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }
    
    public function update(Post $post, StorePostRequest $request)
    {
        /* $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = $request->get('published_at'); 
        $post->category_id = $request->get('category_id');
        $post->save(); */

        $post->update($request->all());

        $post->syncTags($request->get('tags'));

        return redirect()
                ->route('admin.posts.edit', $post)
                ->with('flash', 'La publicación ha sido guardada');
    }

    public function destroy(Post $post)
    {
        /* $post->tags()->detach();

        foreach ($post->photos as $photo) {
            $photo->delete();
        } */

        $post->delete();

        return redirect()
                ->route('admin.posts.index')
                ->with('flash', 'La publicación ha sido eliminada');
    }
}
