@extends('profile.layouts.app')

@section('title', 'Informações do Usuário')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('/storage/img/user/' . $user->image) }}" alt="Foto de perfil">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>E-mail</b> <a class="float-right">{{ $user->email }}</a>
                        </li>
                    </ul>
                    @can('update', $user)
                        <a href="{{ route('profile.users.edit', $user->id) }}" class="btn btn-primary btn-block mb-2"><i
                                class="fas fa-pen"></i> Editar</a>
                    @endcan
                    @can('delete', $user)
                        <form class="form-delete" action="{{ route('profile.users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-trash"></i> Excluir</button>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informações</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted"><strong> Membro desde </strong>
                            {{ date('d/m/Y', strtotime($user->created_at)) }}</h6>
                        <p class="text-muted"><strong> Tipo de usúario </strong> {{ $user->access }}</h6>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <hr>
                                        <h1>Atividades recentes</h1>
                                    </div>
                                    <div class="timeline">
                                        @php $lastDate = 0 @endphp
                                        @foreach ($activities as $activity)
                                            @if ($activity->title != null)
                                                @if (date('d/m/Y', strtotime($activity->created_at)) != $lastDate)
                                                    <div class="time-label">
                                                        <span
                                                            class="bg-green">{{ date('d/m/Y', strtotime($activity->created_at)) }}</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <i class="fas fa-mail-bulk bg-dark"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fas fa-clock"></i>
                                                            {{ date('H:i', strtotime($activity->created_at)) }}</span>
                                                        <h3 class="timeline-header">Publicou: <a
                                                                href="{{ route('blog.view', $activity->id) }}">{{ $activity->title }}</a>
                                                        </h3>
                                                        <div class="timeline-body limite-rows"> {{ $activity->abstract }}
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="{{ route('blog.view', $activity->id) }}"
                                                                class="btn btn-primary btn-sm">Ler mais</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if (date('d/m/Y', strtotime($activity->created_at)) != $lastDate)
                                                    <div class="time-label">
                                                        <span
                                                            class="bg-green">{{ date('d/m/Y', strtotime($activity->created_at)) }}</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <i class="fas fa-pen bg-dark"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fas fa-clock"></i>
                                                            {{ date('H:i', strtotime($activity->created_at)) }}</span>
                                                        <h3 class="timeline-header">Comentou em: <a
                                                                href="{{ route('blog.view', $activity->post->id) }}">{{ $activity->post->title }}</a>
                                                        </h3>
                                                        <div class="timeline-body limite-rows"> {{ $activity->message }}
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="{{ route('blog.view', $activity->post->id) }}"
                                                                class="btn btn-primary btn-sm">Ler mais</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @php $lastDate = date('d/m/Y', strtotime($activity->created_at)) @endphp
                                        @endforeach
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $activities->links() }}
            </div>
        </div>

    @endsection

    @push('scripts')
        <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
    @endpush
