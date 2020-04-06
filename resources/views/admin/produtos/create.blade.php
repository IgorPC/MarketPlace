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
            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{old('nome')}}">
            @error('nome')
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
            <label>Categorias: </label>
            <select name="categorias[]" class="form-control" multiple required>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos do produto</label>
            <input type="file" name="fotos[]" multiple class="form-control @error('fotos.*') is-invalid @enderror">
            @error('fotos.*')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar Produto</button>
        </div>
    </form>
@endsection
