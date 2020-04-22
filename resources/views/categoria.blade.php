@extends('layouts.admin-layout')

@section('titulo')
  {{$categoria->nome}}
@endsection

@section('conteudo')
    <div class="col-md-12">
        <h2>{{$categoria->nome}}</h2>
        <hr>
    </div>
    <div class="row">
    @if($categoria->produtos()->count())
        @foreach($categoria->produtos as $chave => $produto)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    @if($produto->fotos->count())
                        <img src="{{asset('storage/' . $produto->fotos->first()->imagem)}}" class="card-img-top" alt="...">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{$produto->nome}}</h3>
                        <p class="card-text">{{$produto->descricao}}</p>
                        <h5>R$ {{number_format($produto->preco, '2', ',','.')}}</h5>
                        <a href="{{route('single', ['slug' => $produto->slug])}}" class="btn btn-success">Ver Mais</a>
                    </div>
                </div>
            </div>
                @if(($chave + 1) % 3 === 0) </div><div class="row"> @endif
        @endforeach
    @else
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Essa categoria está vazia!</h4>
                <p>Acesse nossos produtos clicando no botão abaixo</p>
                <hr>
                <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('home')}}"><i class="fas fa-store"></i> Clique aqui para ser redirecionado aos produtos da loja <i class="fas fa-store"></i></a></p>
            </div>
        </div>
    @endif
@endsection
