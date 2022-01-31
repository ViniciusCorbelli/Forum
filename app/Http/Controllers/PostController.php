<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\postRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('profile.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        return view('profile.posts.create', compact('post', 'categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if ($request->hasfile('image')) {
            $extesion = $request->image->getClientOriginalExtension();
            $slug = str_slug($request->title);
            $nameFile = "{$slug}.{$extesion}";
            $request->image->storeAs('public/img/posts', $nameFile);
            $data['image'] = $nameFile;
        } else {
            unset($data['image']);
        }
        post::create($data);
        return redirect()->route('profile.posts.index')->with('success', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $categories = Category::all();
        return view('profile.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, post $post)
    {
        $data = $request->all();
        if ($request->hasfile('image')) {
            $extesion = $request->image->getClientOriginalExtension();
            $slug = str_slug($request->title);
            $nameFile = "{$slug}.{$extesion}";
            $request->image->storeAs('public/img/posts', $nameFile);
            $data['image'] = $nameFile;
        } else {
            unset($data['image']);
        }
        $post->update($data);
        return redirect()->route('profile.posts.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        $post->delete();
        return redirect()->route('profile.posts.index')->with('success', true);
    }
}
