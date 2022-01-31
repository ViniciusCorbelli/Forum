@extends('profile.layouts.app')

@section('content')
    @component('profile.components.table')
        @slot('create', route('profile.posts.create'))
            @slot('titulo', 'Mensagem')
                @slot('head')
                    <th>Autor</th>
                    <th>Título</th>
                    <th>Data da criação</th>
                    <th></th>
                @endslot
                @slot('body')
                    @foreach ($posts as $post)
                        @can('view', $post)
                            <tr>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($post->created_at)) }}</td>
                                <td class="options">
                                    <a href="{{ route('blog.view', $post->id) }}" class="btn btn-secondary"><i class="fas fa-eye"></i></i></a>
                                    @can('update', $post)
                                        <a href="{{ route('profile.posts.edit', $post->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $post)
                                        <form method="post" action="{{ route('profile.posts.destroy', $post->id) }}" class="form-delete">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                @endslot
            @endcomponent
        @endsection

        @push('scripts')
            <script src="{{ asset('js/components/dataTable.js') }}"></script>
            <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
        @endpush
