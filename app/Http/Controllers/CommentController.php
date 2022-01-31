<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(CommentRequest $request, $post)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $post;
        Comment::create($data);
        return redirect()->route('blog.view', $data['post_id'])->with('success', true);
    }

    public function edit(Comment $comment)
    {
        return view('profile.comments.edit', compact('comment'));
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        return redirect()->route('blog.view', $comment->post_id)->with('success', true);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('profile.comments.index')->with('success', true);
    }

    public function destroyBlog(Comment $comment)
    {
        $comment_id = $comment->post_id;
        $comment->delete();
        return redirect()->route('blog.view', $comment_id)->with('success', true);
    }
}
