@extends('profile.layouts.app')

@section('content')
    @component('profile.components.edit')
        @slot('title', 'Editar categoria ' . $category->name)
        @slot('url', route('profile.categories.update', $category->id))
        @slot('form')
            @include('profile.categories.form')
        @endslot
    @endcomponent
@endsection