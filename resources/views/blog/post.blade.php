@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="verticals ten offset-by-one">
            <ol class="breadcrumb breadcrumb-fill2">
                <li><a href="{{ route('site.index') }}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="{{ route('blog.category') }}">Categorias</a></li>
                <li><a href="{{ route('blog.category.view', $post->category->id) }}">{{ $post->category->name }}</a></li>
                <li class="active-breadcrumb"> {{ $post->title }}</li>
            </ol>
        </div>
        <h1> {{ $post->title }} </h1>
        <p>Tópico em '{{ $post->category->name }}' criado por {{ $post->user->name }}, {{ date('d/m/Y H:i', strtotime($post->created_at)) }}.</p>
        {{ $comments->links() }}
        @if ($comments->currentPage() == 1)
            <div class="row card-post-show">
                <div class="col-3">
                    <div class="card-post card-post-show card-post-profile">
                        <h1>
                            @if ($post->user->access == 'Administrador') <strong>
                            @endif {{ $post->user->name }} </strong>
                        </h1>
                        <img src={{ asset('/storage/img/user/' . $post->user->image) }} alt="Foto de perfil">
                        <h6><strong> Membro desde </strong>  {{ date('d/m/Y', strtotime($post->user->created_at)) }}</h6>
                        <h6><strong> Tipo de usúario </strong> {{ $post->user->access }}</h6>
                        <h6><strong> Postado em </strong> {{ date('d/m/Y H:i', strtotime($post->created_at)) }}</h6>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-post card-post-show">
                        <img src="{{ asset('/storage/img/posts/' . $post->image) }}" class="elevation-2">
                        <p> {!! $post->message !!} </p>
                        @if (Auth::user() != null && ($post->user_id == Auth::user()->id || Auth::user()->access == 'Administrador'))
                            <td>
                                <a href="{{ route('profile.posts.edit', $post->id) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @foreach ($comments as $comment)
            <div class="row card-post-show">
                <div class="col-3">
                    <div class="card-post card-post-show card-post-profile">
                        <h1>
                            @if ($comment->user->access == 'Administrador') <strong>
                            @endif {{ $comment->user->name }} </strong>
                        </h1>
                        <img src={{ asset('/storage/img/user/' . $comment->user->image) }} alt="Foto de perfil">
                        <h6><strong> Membro desde </strong> {{ date('d/m/Y', strtotime($comment->user->created_at)) }}</h6>
                        <h6><strong> Tipo de usúario </strong> {{ $comment->user->access }}</h6>
                        <h6><strong> Postado em </strong> {{ date('d/m/Y H:i', strtotime($comment->created_at)) }}</h6>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-post card-post-show">
                        <p> {{ $comment->message }} </p>
                        @if (Auth::user() != null && ($comment->user_id == Auth::user()->id || Auth::user()->access == 'Administrador'))
                            <table>
                                <tr>
                                    <td>
                                        <a href="{{ route('profile.comments.edit', $comment->id) }}"
                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form class="form-delete"
                                            action="{{ route('profile.comments.destroyBlog', $comment->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger "><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{ $comments->links() }}

        @if (Auth::user() != null)
            <div class="row card-post-show">
                <div class="col-2 card-post card-post-show card-post-profile card-comment">
                    <img src={{ asset('/storage/img/user/' . $post->user->image) }} alt="Foto de perfil">
                </div>
                <div class="col-9 card-post card-post-show">
                    <h4>Responder tópico</h4>
                    <form action="{{ route('blog.comment.store', $post->id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                        <textarea class="form-control" name="message" id="message" required rows="3"></textarea>
                        <button type="submit" class="btn btn-primary card-button-answer"> Responder</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
