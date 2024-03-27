@extends('layouts.app')

@section('title', 'editar o comentário')

@section('content')
<h1>Editar o comentário do usuário: {{ $user->name }}</h1>

<!-- Mostrar as mensagens de erro de validacao -->

@include('includes.validations-form')


<form action="{{ route('comments.update', $comment->id) }}" method="POST">
    @method('PUT')
    @include('users.comments._partials.form')
</form>

@endsection 

