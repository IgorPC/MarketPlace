@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Loja
@endsection

@section('conteudo')
    <h1>Cadastrar nova categoria</h1>
    <form method="POST" action="{{route('categorias.store')}}">
        @csrf
        <div class="form-group">
            <label>Nome da Categoria</label>
            <input class="form-control @error('nomeLoja') is-invalid @enderror" type="text" name="nomeCategoria" value="{{old('nomeCategoria')}}">
            @error('nomeCategoria')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{old('descricao')}}">
            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
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
