@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Loja
@endsection

@section('conteudo')
<h1>Cadastrar loja</h1>
<form method="POST" action="{{route('lojas.store')}}">
    @csrf
    <div class="form-group">
        <label>Nome da Loja</label>
        <input class="form-control" type="text" name="nomeLoja">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input class="form-control" type="text" name="descricao">
    </div>

    <div class="form-group">
        <label>Celular</label>
        <input class="form-control" type="text" name="celular">
    </div>

    <div class="form-group">
        <label>Telefone</label>
        <input class="form-control" type="text" name="telefone">
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input class="form-control" type="text" name="slug">
    </div>

    <div>
        <button type="submit" class="btn btn-lg btn-success">Salvar</button>
    </div>
</form>
@endsection
