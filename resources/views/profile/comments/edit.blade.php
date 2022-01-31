@extends('profile.layouts.app')

@section('content')
    @component('profile.components.edit')
        @slot('title', 'Editar Comentario')
        @slot('url', route('profile.comments.update', $comment->id))
        @slot('form')
            @include('profile.comments.form')
        @endslot
    @endcomponent
@endsection