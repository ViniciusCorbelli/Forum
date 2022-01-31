@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm form-center">
                <div class="title">
                    <h1>Entrar na sua conta</h1>
                </div>
                <form method="POST" action="{{ route('login') }}" class="form-register">
                    @csrf

                    @if (session('message'))
                        <div class="text-danger mb-3 text-center">
                            <i class="fa fa-exclamation-triangle"></i>
                            {{ session('message') }}
                        </div>
                    @else
                        <p class="form-msg">Faça o login para iniciar sua sessão</p>
                    @endif
                    <div class="form-group row">
                        <label for="email">E-mail</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="password">{{ __('Password') }}</label>

                        <div class="input-group">
                            <span class="input-group-text" onclick="visiblePassword('password' ,'iconPassword')">
                                <i class="fa fa-eye-slash" id='iconPassword'></i>
                            </span>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="buttons button-registrar">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="link-registrar" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class='text-center'>
                        <a href="{{ route('register') }}"><button type="button" class="buttons button-registrar">Cadastre-se</button></a>
                    </div>
                </form>
            </div>
            <div class="col-sm">
                <div class="laptop">
                    <img src="{{ asset('/img/laptop.png') }}" alt="Laptop">
                </div>
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
