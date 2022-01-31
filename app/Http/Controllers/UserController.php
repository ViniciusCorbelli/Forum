<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\UserRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\CustomClasses\ColectionPaginate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('profile.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('profile.users.create', compact('user'));
    }

    public function show(User $user)
    {
        $posts = Post::where('user_id', '=', $user->id)->get();
        $comments = Comment::where('user_id', '=', $user->id)->get();
        $postsAndComments = $posts;
        foreach ($comments as $comment)
            $postsAndComments->push($comment);

        $postsAndComments = $postsAndComments->sortByDesc('created_at');
        $activities = ColectionPaginate::paginate($postsAndComments, 10);
        return view('profile.users.show', compact('user', 'activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        if (Auth::user() == null || Auth::user()->access != "Administrador") {
            $data = $request->except('access', 'confirmed');
        } else {
            $data = $request->all();
        }

        $data = User::bcryptPassword($data);

        if ($request->hasfile('image')) {
            $extesion = $request->image->getClientOriginalExtension();
            $slug = str_slug($request->name);
            $nameFile = "{$slug}.{$extesion}";
            $request->image->storeAs('public/img/user', $nameFile);
            $data['image'] = $nameFile;
        } else {
            unset($data['image']);
        }
        $data['verified'] = 0;
        User::create($data);
        return redirect()->route('profile.users.index')->with('success', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('profile.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if (Auth::user() == null || Auth::user()->access != "Administrador") {
            $data = $request->except('access', 'confirmed');
        } else {
            $data = $request->all();
        }

        $data = User::bcryptPassword($data);
        
        if ($request->hasfile('image')) {
            $extesion = $request->image->getClientOriginalExtension();
            $slug = str_slug($request->name);
            $nameFile = "{$slug}.{$extesion}";
            $request->image->storeAs('public/img/user', $nameFile);
            $data['image'] = $nameFile;
        } else {
            unset($data['image']);
        }
        $user->update($data);
        return redirect()->route('profile.users.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('profile.users.index')->with('success', true);
    }

    public function pendency(User $user)
    {
        $user->update(['verified'=>1]);
        return redirect()->route('profile.users.index')->with('success', true);
    }
}
