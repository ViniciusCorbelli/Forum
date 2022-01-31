@extends('profile.layouts.app')

@section('content')
    @component('profile.components.create')
        @slot('title', 'Criar usuário')
        @slot('url', route('profile.users.store'))
        @slot('form')
            @include('profile.users.form')
        @endslot
    @endcomponent
@endsection
