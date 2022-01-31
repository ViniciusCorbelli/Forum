@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="laptop">
                    <img src="{{ asset('/img/laptop.png') }}" alt="Laptop">
                </div>
            </div>
            <div class="col-sm">

                <div class="title">
                    <h1>Criar sua conta</h1>
                </div>

                <div class="create-acount">
                    <hr>
                </div>
                <form method="POST" action="{{ route('register') }}" class="form-register">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="required" for="password">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text" onclick="visiblePassword('password' ,'iconPassword')">
                                <i class="fa fa-eye-slash" id='iconPassword'></i>
                            </span>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="password">Confirmar Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"
                                onclick="visiblePassword('password-confirm' ,'iconConfirmedPassword')">
                                <i class="fa fa-eye-slash" id='iconConfirmedPassword'></i>
                            </span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group">  
                        <label for="image">Imagem </label>
                        <input type="file" accept="image/*" class="form-control-file" name="image">
                    </div>
                    <div class="buttons-login">
                        <a href="{{ route('login') }}"><button type="button" class="buttons button-registrar">Cancelar</button></a>
                        <button class="buttons button-registrar" type="submit"> Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function visiblePassword($password, $icon) {
            if (document.getElementById($password).type === 'password') {
                document.getElementById($password).type = 'text';
                document.getElementById($icon).classList.add('fa-eye');
                document.getElementById($icon).classList.remove('fa-eye-slash');
            } else {
                document.getElementById($password).type = 'password';
                document.getElementById($icon).classList.add('fa-eye-slash');
                document.getElementById($icon).classList.remove('fa-eye');
            }
        }

    </script>
@endpush
