<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CompuTech | Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

@include('includes.navbar')

<body class="body-site">
    <div class="container">
        <div class="verticals ten offset-by-one">
            <ol class="breadcrumb breadcrumb-fill2">
                <li><a href="{{ route('site.index') }}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="{{ route('profile.users.show', Auth::user()->id) }}">Perfil</a>
                <li class="active-breadcrumb"> {{ Auth::user()->name }}</li>
            </ol>
        </div>
        @yield('content')
    </div>
    @include('profile.includes.success')
    @include('includes.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var errors = {!! $errors !!}

    </script>
    <script src="{{ asset('js/components/error.js') }}"></script>
    @stack('scripts')
</body>

</html>
