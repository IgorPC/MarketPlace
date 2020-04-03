@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Loja
@endsection

@section('conteudo')
<h1>Cadastrar loja</h1>
<form method="POST" action="{{route('lojas.store')}}">
    @csrf
    <div class="form-group">
        <label>Nome da Loja</label>
        <input class="form-control @error('nomeLoja') is-invalid @enderror" type="text" name="nomeLoja" value="{{old('nomeLoja')}}">
        @error('nomeLoja')
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
        <label>Celular</label>
        <input class="form-control @error('celular') is-invalid @enderror" type="text" name="celular" value="{{old('celular')}}">
        @error('celular')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Telefone</label>
        <input class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone" value="{{old('telefone')}}">
        @error('telefone')
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
