@php
setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
@endphp

@foreach ($mensagens as $mensagem)
    <div class="chat @if ($mensagem->user == Auth::user()) chat-enviado @endif">
        <img src="{{ asset('/storage/img/user/' . $mensagem->user->image) }}" alt="{{ $mensagem->user->name }}">
        <h1 class="nome ">{{ $mensagem->user->name }}</h1>
        <span class="time ">{{ strftime('%d %h %H:%M', strtotime($mensagem->created_at)) }}</span>
        <p class="mensagem ">{{ $mensagem->message }}</p>
    </div>
@endforeach
