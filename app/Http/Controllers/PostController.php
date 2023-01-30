<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        // Added middleware web to store method 
        // to be able to display form validation errors
        $this->middleware('web')->only(['store']);
    }

    public function index()
    {

        $posts = auth()->user()->posts;

        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);
    }

    public function create()
    {   
        $this->authorize('create', Post::class);

        return view('admin.posts.create');
    }

    public function store()
    {
        //Form validation

        $this->authorize('create', Post::class);

        $validated = validatePostForm();

        if (request('post_image')) {

            $validated['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($validated);

        session()->flash('post-created-message', 'Post was created');

        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        //Denying edit access to the post that belong
        //to the user throught the use of policy

        $this->authorize('view', $post);

        // if (auth()->user()->can('view',$post)) {
        //     # code...
        // }

        return view('admin.posts.edit', ['post' => $post]);
    }

    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $request->session()->flash('message', 'Post was deleted');

        return back();
    }

    public function update(Post $post)
    {

        $validated = validatePostForm();


        if (request('post_image')) {

            $validated['post_image'] = request('post_image')->store('images');
            $post->post_image = $validated['post_image'];
        }

        $post->title = $validated['title'];
        $post->body = $validated['body'];

        // auth()->user()->posts()->save($post);

        //Denying update to the posts
        //who dont belong to the user through the use of policy
        $this->authorize('update', $post);

        $post->save();

        session()->flash('post-created-message', 'Post was updated');

        return redirect()->route('post.index');
    }
}
