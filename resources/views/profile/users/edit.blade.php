@extends('profile.layouts.app')

@section('content')
    @component('profile.components.edit')
        @slot('title', 'Editar usuário ' . $user->name)
        @slot('url', route('profile.users.update', $user->id))
        @slot('form')
            @include('profile.users.form')
        @endslot
    @endcomponent
@endsection
