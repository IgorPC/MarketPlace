@extends('layouts.admin-layout')

@section('titulo')
    Atualizar Produto
@endsection

@section('conteudo')
    <h1>Atualizar Produto</h1>
    <form method="POST" action="{{route('produto.update',['produto' => $produto->id])}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Nome do produto</label>
            <input class="form-control @error('nomeProduto') is-invalid @enderror" value="{{$produto->nome}}" type="text" name="nomeProduto">
            @error('nomeProduto')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteudo</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="" cols="30" rols="10">{{$produto->body}}</textarea>
            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control @error('descricao') is-invalid @enderror" value="{{$produto->descricao}}" type="text" name="descricao">
            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input class="form-control @error('preco') is-invalid @enderror" value="{{$produto->preco}}" type="text" name="preco">
            @error('preco')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" value="{{$produto->slug}}" type="text" name="slug">
        </div>

        <div class="form-group">
            <label>Loja</label>
            <select name="loja" class="form-control">
                @foreach($lojas as $loja)
                    <option value="{{$loja->id}}">{{$loja->nome}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-lg btn-primary mb-4">Atualizar Produto</button>
        </div>
    </form>
@endsection
