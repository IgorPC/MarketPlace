@extends('layouts.admin-layout')

@section('titulo')
    Home
@endsection

@section('conteudo')
    <br>
    <h2>Produtos em destaque:</h2>
    <hr>
    <div class="row">
    @foreach($produtos as $chave => $produto)
        <div class="col-md-4">
            <div class="card mb-2" style="width: 18rem;">
                @if($produto->fotos->count())
                    <img src="{{asset('storage/' . $produto->fotos->first()->imagem)}}" class="card-img-top" alt="Responsive image" style="width: auto; height: 200px; object-fit: fill;">
                @else
                    <img src="https://via.placeholder.com/600X420.png?text=PRODUTO%20SEM%20IMAGEM" class="card-img-top" alt="...">
                @endif
                <div class="card-body" style="height: 220px">
                    <h3 class="card-title">{{$produto->nome}}</h3>
                    <p class="card-text">{{$produto->descricao}}</p>
                    <h5>R$ {{number_format($produto->preco, '2', ',','.')}}</h5>
                    <a href="{{route('single', ['slug' => $produto->slug])}}" class="btn btn-success">Ver Mais</a>
                </div>
            </div>
        </div>
            @if(($chave + 1) % 3 === 0) </div><div class="row"> @endif
    @endforeach
    </div>
    <div class="col-12 mt-4">
        <h2>Lojas em Destaque</h2>
        <hr>
    </div>
    <div class="row">
        @foreach($lojas as $loja)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    @if($loja->logo)
                        <img src="{{asset('storage/' . $loja->logo)}}" class="card-img-top" alt="Responsive image" style="width: auto; height: 150px; object-fit: fill;">
                    @else
                        <img src="https://via.placeholder.com/600X420.png?text=LOJA%20SEM%20LOGO" class="card-img-top" alt="Responsive image">
                    @endif
                        <div class="card-body" style="height: 150px">
                            <h3 class="card-title">{{$loja->nome}}</h3>
                            <p class="card-text">{{$loja->descricao}}</p>
                            <a href="{{route('loja.index', ['slug' => $loja->slug])}}" class="btn btn-success">Ver Mais</a>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
