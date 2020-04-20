@extends('layouts.admin-layout')

@section('titulo')
    Atualizar Loja
@endsection

@section('conteudo')
    <h1 class="mt-4">Atualizar loja</h1>
    <form method="POST" action="{{route('lojas.update',['loja' => $loja->id])}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group mt-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 40px;" id="inputGroup-sizing-default"><strong>Nome</strong></span>
                </div>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$loja->nome}}">
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
                <input type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$loja->descricao}}">
                @error('descricao')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 32px;" id="inputGroup-sizing-default"><strong>Celular</strong></span>
                </div>
                <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$loja->celular}}">
                @error('celular')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 20px;" id="inputGroup-sizing-default"><strong>Telefone</strong></span>
                </div>
                <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$loja->telefone}}">
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
                <div class="form-group">
                    <label>Alterar Logo:</label>
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" style="height: 20%">
                    @error('logo')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lg btn-warning mb-4">Atualizar Loja</button>
            </div>
        </div>
    </form>
@endsection
