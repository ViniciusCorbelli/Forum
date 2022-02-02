@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="verticals ten offset-by-one">
            <ol class="breadcrumb breadcrumb-fill2">
                <li><a href="{{ route('site.index') }}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="active-breadcrumb"> Categorias </li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="card-post categories">
                    <h1>Categorias</h1>
                    @foreach ($categories as $category)
                        <hr>
                        @php
                            $lastPost = App\Post::where('category_id', '=', $category->id)->where('active', '1')
                                ->latest()
                                ->first();
                            $countPost = App\Post::where('category_id', '=', $category->id)->where('active', '1')->count();
                        @endphp
                        <div class="row">
                            <div class="col-8">
                                <h6> <Strong> <a href="{{ route('blog.category.view', $category->id) }}">
                                            {{ $category->name }} </a> </Strong> </h6>
                                <p> Último post:
                                    {{ $lastPost == null ? 'Não há post nessa categoria' : $lastPost->title }}
                                </p>
                            </div>
                            <div class="col-4 text-right">
                                <p> {{ $countPost }} postagens</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-post">
                    <a class="twitter-timeline" data-height="600" data-theme="light"
                        href="https://twitter.com/UFJF_">Tweets por UFJF</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>
@endsection
