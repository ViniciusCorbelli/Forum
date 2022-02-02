@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($countPost == 0)
            <div class="verticals ten offset-by-one">
                <ol class="breadcrumb breadcrumb-fill2">
                    <li><a href="{{ route('site.index') }}"><i class="fa fa-home"></i></a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                </ol>
            </div>
            <center>
                <h1> CompuTech </h1>
                <p> Não foram encontrados resultados para sua pesquisa.</p>
            </center>
        @else
            <div class="row">
                <div class="col-sm-8 pl-1 pr-1">
                    <div class="row spotlight">
                        <div class="col-sm-6 card-spotlight card-spotlight-1">
                            <a href="{{ route('blog.view', $topPost[0]->id) }}">
                                <img src="{{ asset('/storage/img/posts/' . $topPost[0]->image) }}" alt="Post em destaque">
                                <div class="card-spotlight-text">
                                    <p>{{ $topPost[0]->subtitle }}</p>
                                    <h1>{{ $topPost[0]->title }}</h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                @for ($i = 1; $i < 3; $i++)
                                    <div class="col-sm-12 card-spotlight card-spotlight-2">
                                        @if ($countPost > $i)
                                            <a href={{ route('blog.view', $topPost[$i]->id) }}>
                                                <img src="{{ asset('/storage/img/posts/' . $topPost[$i]->image) }}"
                                                    alt="Post em destaque">
                                                <div class="card-spotlight-text">
                                                    <p>{{ $topPost[$i]->subtitle }}</p>
                                                    <h1>{{ $topPost[$i]->title }}</h1>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @foreach ($posts as $post)
                        <div class="card-post card-post-author">
                            <img src="{{ asset('storage/img/user/' . $post->user->image) }}" alt="Foto de perfil">
                            <h5>Postado por {{ $post->user->name }} </h5>
                            <h6>{{ date('d/m/Y H:i', strtotime($post->created_at)) }}</h6>
                        </div>
                        <div class="card-post card-post-title">
                            <h5> {{ $post->category->name }} </h5>
                            <h2> {{ $post->title }} </h2>
                            <h3> {{ $post->subtitle }} </h3>
                        </div>
                        <div class="card-post card-post-content">
                            <img src="{{ asset('/storage/img/posts/' . $post->image) }}" class="elevation-2">
                            <p> {!! $post->abstract !!} </p>
                            <div class="card-post-footer">
                                <a href="{{ route('blog.view', $post->id) }}"><button type="button"
                                        class="btn btn-primary card-button">Continue
                                        lendo</button></a>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
                <div class="col-sm-4 pl-3 pr-1">
                    <div class="card-post">
                        <a class="twitter-timeline" data-height="800" data-theme="light"
                            href="https://twitter.com/UFJF_">Tweets por UFJF</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
