@extends('profile.layouts.app')

@section('content')
    @component('profile.components.edit')
        @slot('title', 'Editar Post')
        @slot('url', route('profile.posts.update', $post->id))
        @slot('form')
            @include('profile.posts.form')
        @endslot
    @endcomponent
@endsection