@extends('layouts.admin-layout')

@section('titulo')
    Buscar
@endsection

@section('conteudo')
    <br>
    <h2>Produtos em destaque:</h2>
    <hr>
    <div class="row">
        @foreach($produtos as $chave => $produto)
            <div class="col-md-4">
                <div class="card mb-2" style="width: 18rem;">
                    @if($foto = \App\ProdutoFoto::where('produto_id', $produto->id)->first())
                        <img src="{{asset('storage/' . $foto->imagem)}}" class="card-img-top" alt="..." style="width: auto; height: 200px; object-fit: fill;">
                    @else
                        <img src="https://via.placeholder.com/600X420.png?text=PRODUTO%20SEM%20IMAGEM" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body" style="height: 220px">
                        <h5 class="card-title">{{$produto->nome}}</h5>
                        <p class="card-text">{{$produto->descricao}}</p>
                        <h5>R$ {{number_format($produto->preco, '2', ',','.')}}</h5>
                        <a href="{{route('single', ['slug' => $produto->slug])}}" class="btn btn-success">Ver Mais</a>
                    </div>
                </div>
            </div>
            @if(($chave + 1) % 3 === 0) </div><div class="row"> @endif
        @endforeach
        <div class="mt-4">
            {{$produtos->links()}}
        </div>
    </div>
@endsection
