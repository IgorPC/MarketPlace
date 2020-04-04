@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Produto
@endsection

@section('conteudo')
    <h1>Cadastrar Produto</h1>
    <form method="POST" action="{{route('produto.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nome do produto</label>
            <input class="form-control @error('nomeProduto') is-invalid @enderror" type="text" name="nomeProduto" value="{{old('nomeProduto')}}">
            @error('nomeProduto')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteudo</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="" cols="30" rols="10">{{old('body')}}</textarea>
            @error('body')
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
            <label>Preço</label>
            <input class="form-control @error('preco') is-invalid @enderror" type="text" name="preco" value="{{old('preco')}}">
            @error('preco')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div>

        <div class="form-group">
            <label>Categorias: </label>
            <select name="categorias[]" class="form-control" multiple>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos do produto</label>
            <input type="file" name="fotos[]" multiple class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar Produto</button>
        </div>
    </form>
@endsection
