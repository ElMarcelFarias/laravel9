@extends('layouts.app')

@section('title', 'editar o usuário')

@section('content')
<h1>Editar o usuário: {{ $user->name }}</h1>

<!-- Mostrar as mensagens de erro de validacao -->

@include('includes.validations-form')


<form action="{{ route('users.update', $user->id) }}" method="POST">
    @method('PUT')
    @include('users._partials.form')
</form>

@endsection 

