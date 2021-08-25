<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->json([
            'posts' => $posts,
        ]);
    }

    public function search(Request $request) {
        $posts = Post::where('title', 'LIKE',  '%'.$request->q.'%' )
            ->orWhere('content', 'LIKE', '%'.$request->q.'%')
            ->limit(20)
            ->get();

        return response()->json([
            'posts' => $posts
        ]);
    }
}
