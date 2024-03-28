@extends('layouts.app')

@section('title', 'Criar um novo usuário')

@section('content')
<h1>Novo usuário</h1>

<!-- Mostrar as mensagens de erro de validacao -->

@include('includes.validations-form')


<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('users._partials.form')
    
</form>

@endsection 

