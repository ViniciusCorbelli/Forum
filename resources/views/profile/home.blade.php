@extends('profile.layouts.app')

@section('content')
    @php
    $totalUsers = 0;
    $totalUsersNews = 0;
    $TotalPosts = 0;
    $TotalPostsNews = 0;

    foreach ($users as $user) {
        if (date('m', strtotime($user->created_at)) == date('m')) {
            $totalUsersNews++;
        }
        $totalUsers++;
    }

    foreach ($posts as $post) {
        if (date('d', strtotime(date('d/m/Y H:i', strtotime($post->created_at)))) == date('m')) {
            $TotalPostsNews++;
        }
        $TotalPosts++;
    }

    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">Visão geral</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $totalUsers }}</h3>
                                        <p>Úsuarios</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <a href="{{ route('profile.users.index') }}" class="small-box-footer">
                                        Mais informações <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="small-box bg-gradient-success">
                                    <div class="inner">
                                        <h3>{{ $totalUsersNews }}</h3>
                                        <p>Novos Úsuarios no mês</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <a href="{{ route('profile.users.index') }}" class="small-box-footer">
                                        Mais informações <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $TotalPosts }}</h3>
                                        <p>Posts</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-mail-bulk"></i>
                                    </div>
                                    <a href="{{ route('profile.posts.index') }}" class="small-box-footer">
                                        Mais informações <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="small-box bg-dark">
                                    <div class="inner">
                                        <h3>{{ $TotalPostsNews }}</h3>
                                        <p>Novos Posts no mês</p>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <a href="{{ route('profile.posts.index') }}" class="small-box-footer">
                                        Mais informações <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
