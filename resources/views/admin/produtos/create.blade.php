@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Produto
@endsection

@section('conteudo')
    <h1>Cadastrar Produto</h1>
    <form method="POST" action="{{route('produto.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Nome</strong></span>
            </div>
            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('nome')}}">
            @error('nome')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Conteudo</strong></span>
            </div>
            <input type="text" name="body" class="form-control @error('body') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('body')}}">
            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Descrição</strong></span>
            </div>
            <input type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('descricao')}}">
            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Preço</strong></span>
            </div>
            <input type="text" name="preco" class="form-control @error('preco') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('preco')}}">
            @error('preco')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01"><strong>Categorias</strong></label>
            </div>
            <select name="categorias[]" class="custom-select" id="inputGroupSelect01" multiple required>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos do produto</label>
            <input type="file" name="fotos[]" multiple class="form-control @error('fotos.*') is-invalid @enderror" style="height: 20%">
            @error('fotos.*')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success mb-4">Cadastrar Produto</button>
        </div>
    </form>
@endsection
