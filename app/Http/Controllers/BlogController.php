<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $topPost = Post::orderBy('views', 'desc')->get();
        $countPost = count(Post::all());
        return view('blog.index', compact('posts', 'topPost', 'countPost'));
    }

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', '=', $post->id)->paginate(10);
        if ($comments->currentPage() == 1) {
            $post->views++;
            $post->save();
        }
        return view('blog.post', compact('post', 'comments'));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('blog.category.index', compact('categories'));
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', '=', $category->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('blog.category.view', compact('posts', 'category'));
    }

    public function dates()
    {
        return view('blog.date.index');
    }

    public function date($month, $year)
    {
        $posts = Post::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('created_at', 'desc')->paginate(10);
        $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        $month = $months[($month - 1)%12];
        return view('blog.date.view', compact('month', 'posts', 'year'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('message', 'LIKE', "%{$search}%")
            ->orderBy('created_at', 'desc')->get();

        return view('blog.search', compact('posts', 'search'));
    }
}
