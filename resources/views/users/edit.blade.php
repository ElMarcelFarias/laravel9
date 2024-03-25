@extends('layouts.app')

@section('title', 'editar o usuário')

@section('content')
<h1>Editar o usuário: {{ $user->name }}</h1>

<!-- Mostrar as mensagens de erro de validacao -->

@if ($errors->any())
    <ul class="errors">
        @foreach($errors->all() as $error)
            <li class="error">{{ $error }}</li>
        @endforeach
    </ul>
@endif


<form action="{{ route('users.update', $user->id) }}" method="POST">
    @method('PUT')
    @csrf
    <input type="text" name="name" placeholder="Nome: " value="{{ $user->name }}">
    <input type="email" name="email" placeholder="E-mail: " value="{{ $user->email }}">
    <input type="password" name="password" placeholder="Senha: ">
    <button type="submit">
        Enviar
    </button>
</form>

@endsection 

