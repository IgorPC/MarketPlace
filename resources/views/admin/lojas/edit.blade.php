@extends('layouts.admin-layout')

@section('titulo')
    Atualizar Loja
@endsection

@section('conteudo')
    <h1>Atualizar loja</h1>
    <form method="POST" action="{{route('lojas.update',['loja' => $loja->id])}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Nome da Loja</label>
            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{$loja->nome}}">
            @error('nome')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{$loja->descricao}}">
            @error('descricao')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular</label>
            <input class="form-control @error('celular') is-invalid @enderror" type="text" name="celular" value="{{$loja->celular}}">
            @error('celular')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{$loja->telefone}}">
            @error('telefone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="col-5 text-center">
            <div class="form-group">
                <label>Logo: </label>
                <img class="img-fluid" src="{{asset('storage/' . $loja->logo)}}">
            </div>
        </div>

        <div class="form-group">
            <label>Logo:</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-primary mb-4">Atualizar</button>
        </div>
    </form>
@endsection
