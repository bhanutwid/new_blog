<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }
    public function show($id)
    {
    $post = Post::find($id);

    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }
    return response()->json($post);
    }
    public function update(Request $request, $id)
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
    
            return response()->json($post);
        }
    
        return response()->json(['message' => 'Post not found'], 404);
    }
    

}

