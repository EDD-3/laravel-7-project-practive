<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('web')->only(['store']);
    }

    public function show(Post $post) {
        
        return view('blog-post', ['post' => $post]);
    }

    public function create () {
        return view('admin.posts.create');
    }

    public function store () {
        //Form validation

        $validated = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'required|file',
            'body'=>'required',
        ]);


        if(request('post_image')){
           
            $validated['post_image'] = request('post_image')->store('images');
            
        }


        auth()->user()->posts()->create($validated);

       

        return back();

    }
}
