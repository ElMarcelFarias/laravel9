@extends('layouts.app')

@section('title', "Comentários do Usuário {$user->name} ")

@section('content')
<h1 class="text-2x1 font-semibold leading-tigh py-2">Comentários do Usuário {{ $user->name }} <a href="{{ route('comments.create', $user->id) }}" class="bg-blue-900 rounded-full text-white px-4 text-sm"> (+)</a></h1>

<form action="{{ route('comments.index', $user->id) }}" method="GET" class="py-5">
    <input type="text" name="search" placeholder="pesquisar usuário..." class="md:w-1/6 bg-gray-200 appearance-none">
    <button class="shadow bg-purple-500 hover:bg-purple">Pesquisar</button>
</form>

<ul>
    @foreach($comments as $comment)
        <li>
            {{ $comment->body }} - 
            {{ $comment->visible ? 'SIM' : 'NÃO'}} 
            | <a href="{{ route('comments.edit', ['id' => $user->id, 'id_comments' => $comment->id]) }}">Editar</a>
        </li>
    @endforeach
</ul>

@endsection