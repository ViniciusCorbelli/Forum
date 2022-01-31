@extends('profile.layouts.app')

@section('content')
    @component('profile.components.create')
        @slot('title', 'Criar categoria')
        @slot('url', route('profile.categories.store'))
        @slot('form')
            @include('profile.categories.form')
        @endslot
    @endcomponent
@endsection