<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function index()
    {
        // $posts = Post::all();
        // $posts = auth()->user()->posts; //ambil data yg post dari user yg login ini saja

        $posts = auth()->user()->posts()->paginate(5);



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
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message', 'Post with title was created ' . $inputs['title']);
        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        // if (auth()->user()->can('view', $post)) {
        // }
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        //disave sesuai user yg login
        // auth()->user()->posts()->save($post);

        $this->authorize('update', $post);

        $post->save(); //save biasa

        // $post->update($inputs);
        session()->flash('post-updated-message', 'Post with title was updated ' . $inputs['title']);
        return redirect()->route('post.index');
    }

    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete', $post);

        $post->delete();
        // Session::flash('message', 'Post was deleted');
        $request->session()->flash('message', 'Post was deleted');
        return back();
    }
}
