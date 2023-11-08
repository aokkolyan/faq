<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view ('posts.postindex',compact('posts'));
    }
    public function create(): View
    {
        return view('postsCreate');
    }
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
             'title' => 'required',
             'body' => 'required'
        ]);
   
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
   
        return back()
                ->with('success','Post created successfully.');
    }
}
