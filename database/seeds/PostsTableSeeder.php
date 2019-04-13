<?php

use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        Post::truncate();

        $post = new Post;
        $post->title = "Mi primer post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi primer post";
        $post->body = "<p>Contenido de mi primer post</p>";
        $post->iframe = "<iframe width='100%' height='480' src='https://www.youtube.com/embed/1B3Zc6Be4pM' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        $post->published_at = Carbon::now()->subDays(7);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Mi segundo post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi segundo post";
        $post->body = "<p>Contenido de mi segundo post</p>";
        $post->published_at = Carbon::now()->subDays(6);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Mi tercer post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi tercer post";
        $post->body = "<p>Contenido de mi tercer post</p>";
        $post->iframe = "<iframe width='100%' height='480' src='https://www.youtube.com/embed/1B3Zc6Be4pM' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        $post->published_at = Carbon::now()->subDays(5);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Mi cuarto post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi cuarto post";
        $post->body = "<p>Contenido de mi cuarto post</p>";
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id = 3;
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Mi quinto post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi quinto post";
        $post->body = "<p>Contenido de mi quinto post</p>";
        $post->iframe = "<iframe width='100%' height='480' src='https://www.youtube.com/embed/1B3Zc6Be4pM' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 3;
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Mi sexto post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi sexto post";
        $post->body = "<p>Contenido de mi sexto post</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->title = "Mi septimo post";
        $post->url = str_slug($post->title);
        $post->excerpt = "Extracto de mi septimo post";
        $post->body = "<p>Contenido de mi septimo post</p>";
        $post->iframe = "<iframe width='100%' height='480' src='https://www.youtube.com/embed/1B3Zc6Be4pM' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 3;
        $post->user_id = 1;
        $post->save();
    }
}
