@extends('layouts.admin-layout')

@section('titulo')
    Cadastrar Loja
@endsection

@section('conteudo')
    <br>
    <h1>Cadastrar loja</h1>
    <form method="POST" action="{{route('lojas.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 40px;" id="inputGroup-sizing-default"><strong>Nome</strong></span>
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
                    <span class="input-group-text" style="padding-right: 42px;" id="inputGroup-sizing-default"><strong>Email</strong></span>
                </div>
                <input type="text" name="email" id="celular" class="form-control @error('email') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('email')}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 32px;" id="inputGroup-sizing-default"><strong>Celular</strong></span>
                </div>
                <input type="text" name="celular" id="celular" class="form-control @error('celular') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('celular')}}">
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
                <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{old('telefone')}}">
                @error('telefone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
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
                <button type="submit" class="btn btn-lg btn-success mb-4">Cadastrar Loja</button>
            </div>
        </div>
    </form>
@endsection
