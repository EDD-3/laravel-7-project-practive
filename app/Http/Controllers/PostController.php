<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function show(Post $post) {
        
        return view('blog-post', ['post' => $post]);
    }

    public function create () {
        return view('admin.posts.create');
    }

    public function store () {
        //Form validation
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'body' => 'required',
            'post_image' => 'file'
        ]);

        if(request ('post_image')) {

            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user();
        dd(request()->all());

    }
}
