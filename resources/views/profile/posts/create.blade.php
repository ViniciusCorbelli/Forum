@extends('profile.layouts.app')

@section('content')
    @component('profile.components.create')
        @slot('title', 'Criar Post')
        @slot('url', route('profile.posts.store'))
        @slot('form')
            @include('profile.posts.form')
        @endslot
    @endcomponent
@endsection