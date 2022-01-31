@extends('profile.layouts.app')

@section('content')
    @component('profile.components.table')
        @slot('create', route('profile.users.create'))
            @slot('titulo', 'Usuários')
                @slot('head')
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th></th>
                @endslot
                @slot('body')
                    @foreach ($users as $user)
                        @can('view', $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->access }}</td>

                                <td class="options">
                                    @can('delete', $user)
                                        @if ($user->verified == 0)
                                            <form class="form-save" action="{{ route('profile.users.pendency', $user->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-warning "> <i class="fas fa-check"></i></button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-success "> <i class="fas fa-check"></i></button>
                                        @endif
                                    @endcan
                                    @can('update', $user)
                                        <a href="{{ route('profile.users.edit', $user->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $user)
                                        <form method="post" action="{{ route('profile.users.destroy', $user->id) }}" class="form-delete">
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
