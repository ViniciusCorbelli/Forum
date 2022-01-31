@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="verticals ten offset-by-one">
            <ol class="breadcrumb breadcrumb-fill2">
                <li><a href="{{ route('site.index') }}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="active-breadcrumb"> Datas </li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="card-post categories">
                    <h1>Datas</h1>
                    @php
                        $qnt = 24;
                        $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                        $month = strtotime(date('Y-m'));
                    @endphp

                    @for ($i = 0; $i < $qnt; $i++)
                        <hr>
                        <div class="row">
                            <div class="col-8">
                                <h6> <Strong>
                                        <a href="{{ route('blog.date.view', [date('m', $month), date('Y', $month)]) }}">
                                            {{ $months[date('m', $month) - 1] }} de {{ date('Y', $month) }}</a>
                                    </Strong> </h6>
                            </div>
                            <div class="col-4 text-right">
                                <p> {{ count(
    App\Post::whereMonth('created_at', date('m', $month))->whereYear('created_at', date('Y', $month))->get(),
) }}
                                    postagens</p>
                            </div>
                        </div>
                        @php
                            $month = strtotime('-1 month', $month);
                        @endphp
                    @endfor
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-post">
                    <a class="twitter-timeline" data-height="600" data-theme="light"
                        href="https://twitter.com/Code_junior">Tweets por Code Empresa Júnior</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>
@endsection
