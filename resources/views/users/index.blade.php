@extends('layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
<h1>Listagem de usuários <a href="{{ route('users.create') }}"> (+)</a></h1>

<ul>
    @foreach($users as $user)
        <li>
            {{$user->name}} - 
            {{$user->email}} 
            | <a href="{{ route('users.show', ['id' => $user->id]) }}">Detalhes</a>
            | <a href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a>
        </li>
    @endforeach
</ul>

@endsection