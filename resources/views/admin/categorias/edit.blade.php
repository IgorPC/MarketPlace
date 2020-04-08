@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Loja
@endsection

@section('conteudo')
    <h1 class="mt-4">Atualizar categoria</h1>
    <form method="POST" action="{{route('categorias.update', ['categoria' => $categoria->id])}}">
        @method('PUT')
        @csrf

        <div class="form-group mt-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Nome</strong></span>
                </div>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$categoria->nome}}">
                @error('nome')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Descrição</strong></span>
                </div>
                <input type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$categoria->descricao}}">
                @error('descricao')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-lg btn-warning">Atualizar Categoria</button>
            </div>
        </div>
    </form>
@endsection
