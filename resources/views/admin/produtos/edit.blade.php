@extends('layouts.admin-layout')

@section('titulo')
    Atualizar Produto
@endsection

@section('conteudo')
    <h1>Atualizar Produto</h1>
    <form method="POST" action="{{route('produto.update',['produto' => $produto->id])}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Nome do produto</label>
            <input class="form-control @error('nome') is-invalid @enderror" value="{{$produto->nome}}" type="text" name="nome">
            @error('nome')
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
            <label>Categorias: </label>
            <select name="categorias[]" class="form-control" multiple required>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}" @if($produto->categoria->contains($categoria)) selected @endif>{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            @foreach($produto->fotos as $foto)
                <div class="col-5 text-center">
                    <div class="form-group">
                        <img class="img-fluid" src="{{asset('storage/' . $foto->imagem)}}">
                        <form action="{{route('removerFoto')}}" method="POST">
                            @csrf
                            <input name="nomeFoto" type="hidden" value="{{$foto->imagem}}">
                            <button type="submit" class="btn btn-lg btn-danger mt-1">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
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
            <button type="submit" class="btn btn-lg btn-primary mb-4">Atualizar Produto</button>
        </div>
    </form>
@endsection
