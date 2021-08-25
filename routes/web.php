<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::get('/posts', function () {
    return response()->json([
        'posts' => \App\Models\Post::all()
    ]);
});

Route::post('/posts/search', function () {

    $posts = \App\Models\Post::where('title', 'LIKE',  '%'.request()->q.'%' )
            ->orWhere('content', 'LIKE', '%'.request()->q.'%')
            ->limit(20)
            ->get();

    return response()->json([
        'posts' => $posts
    ]);
});