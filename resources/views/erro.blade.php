@extends('layouts.admin-layout')

@section('titulo')
    Verifique seus dados
@endsection

@section('conteudo')
    <br>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Seus dados de cadastro estão incompletos!</h4>
        <p>Para finalizar a compra você deve atualizar seus dados de cadastro.</p>
        <hr>
        <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('usuario.editar')}}"><i class="fas fa-user"></i> Clique aqui para editar os dados <i class="fas fa-user"></i></a></p>
    </div>
@endsection
