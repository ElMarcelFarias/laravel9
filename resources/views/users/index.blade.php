@extends('layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
<h1 class="text-2x1 font-semibold leading-tigh py-2">Listagem de usuários <a href="{{ route('users.create') }}" class="bg-blue-900 rounded-full text-white px-4 text-sm"> (+)</a></h1>

<form action="{{ route('users.index') }}" method="GET" class="py-5">
    <input type="text" name="search" placeholder="pesquisar usuário..." class="md:w-1/6 bg-gray-200 appearance-none">
    <button class="shadow bg-purple-500 hover:bg-purple">Pesquisar</button>
</form>

<ul>
    @foreach($users as $user)
        <li>
            {{$user->name}} - 
            {{$user->email}} 
            | <a href="{{ route('users.show', ['id' => $user->id]) }}">Detalhes</a>
            | <a href="{{ route('comments.index', ['id' => $user->id]) }}">Comentários</a>
            | <a href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a>
        </li>
    @endforeach
</ul>

@endsection