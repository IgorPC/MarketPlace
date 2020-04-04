@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Loja
@endsection

@section('conteudo')
    <h1>Atualizar categoria</h1>
    <form method="POST" action="{{route('categorias.update', ['categoria' => $categoria->id])}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Nome da Categoria</label>
            <input class="form-control @error('nomeLoja') is-invalid @enderror" value="{{$categoria->nome}}" type="text" name="nomeCategoria" value="{{old('nomeCategoria')}}">
            @error('nomeCategoria')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control @error('descricao') is-invalid @enderror" value="{{$categoria->descricao}}" type="text" name="descricao" value="{{old('descricao')}}">
            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" value="{{$categoria->slug}}" name="slug">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        </div>
    </form>
@endsection
