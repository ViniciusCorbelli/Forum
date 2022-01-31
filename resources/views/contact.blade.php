@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1> ENVIE UMA MENSAGEM </h1>
            <h3><i class="fas fa-envelope"></i> contato@ufjf.com.br | <i class="fab fa-instagram"></i> @UFJF</h3>
        </div>
        <form class="form-contact" method="post" action="{{ route('site.contact.send') }}">
            {{ csrf_field() }}


            <div class="form-group col-12">
                <label for="name" class="required">Nome </label>
                <input type="text" name="name" id="name" required class="form-control">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-12">
                <label for="email" class="required">E-mail </label>
                <input type="email" name="email" id="email" required class="form-control" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-12">
                <label for="subject" class="required">Assunto </label>
                <input type="text" name="subject" id="subject" required class="form-control" autofocus>

                @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-12">
                <label for="message" class="required">Mensagem </label>
                <textarea name="message" id="message" required class="form-control"></textarea>

                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="buttons button-registrar">Enviar</button>
        </form>
        <div class="text-center phone-contact">
            <h1> LIGUE PARA NÓS </h1>
            <h3><i aria-hidden="true" class="fas fa-phone-alt"></i> +55 99 99999-9999</h3>
        </div>
    </div>
@endsection
