<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Lihat semua postingan
    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json($posts);
    }

    // Tambah postingan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($request->all());

        return response()->json($post, 201);
    }
}

