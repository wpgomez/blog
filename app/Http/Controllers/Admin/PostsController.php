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
        $posts = Post::allowed()->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Post);

        $this->validate($request, ['title' => 'required|min:3']);

        $post = Post::create( $request->all() );

        // $post = Post::create([
        //     'title' => $request->get('title'),
        //     'user_id' => auth()->id(),
        // ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
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

        $this->authorize('update', $post);

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
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
                ->route('admin.posts.index')
                ->with('flash', 'La publicación ha sido eliminada');
    }
}
