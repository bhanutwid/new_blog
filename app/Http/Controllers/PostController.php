<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    public function getAllPost()
    {   $cachedPosts = Redis::get('posts');

        if ($cachedPosts) {
            $posts = json_decode($cachedPosts);
        } else {
            $posts = Post::all();
            Redis::set('posts', json_encode($posts)); 
            Redis::expire('posts', 60); 
        }
    
        return response()->json($posts);
    }
    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        Redis::del('posts'); 
        return response()->json($post, 201);
    }
    public function getPostById($id)
    {
        $cachedPost = Redis::get("post_{$id}");

        if ($cachedPost) {
            $post = json_decode($cachedPost);
        } else {
            $post = Post::find($id);
    
            if ($post) {
                Redis::set("post_{$id}", json_encode($post)); 
                Redis::expire("post_{$id}", 60); 
            } else {
                return response()->json(['message' => 'Post not found'], 404);
            }
        }
    
        return response()->json($post);
    }
    public function updatePostById(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = Post::find($id);
        if ($post) {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
            Redis::set("post_{$id}", json_encode($post)); 
            Redis::del('posts'); 
            return response()->json($post);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }
    public function deletePostById($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
    
            Redis::del("post_{$id}"); 
            Redis::del('posts'); 
    
            return response()->json(['message' => 'Post deleted successfully']);
        }
    
        return response()->json(['message' => 'Post not found'], 404);
    }

}

