@extends('layout.admin-layout')

@section('conteudo')
    <h1>Atualizar loja</h1>
    <form method="POST" action="{{route('lojas.update',['loja' => $loja->id])}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Nome da Loja</label>
            <input class="form-control" type="text" name="nomeLoja" value="{{$loja->nome}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao" value="{{$loja->descricao}}">
        </div>

        <div class="form-group">
            <label>Celular</label>
            <input class="form-control" type="text" name="celular" value="{{$loja->celular}}">
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control" type="text" name="telefone" value="{{$loja->telefone}}">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug" value="{{$loja->slug}}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-primary">Atualizar</button>
        </div>
    </form>
@endsection
