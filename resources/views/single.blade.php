@extends('layouts.admin-layout')

@section('titulo')
    {{$produto->nome}}
@endsection

@section('conteudo')
    <br>
    @include('layouts.mensagens.mensagemVerde')

    <div class="row">
        <div class="col-6">
            @if($produto->fotos->count())
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset('storage/' . $produto->fotos->first()->imagem)}}" class="d-block w-100" alt="Responsive image">
                        </div>
                        @foreach($produto->fotos as $foto)
                        <div class="carousel-item">
                            <img src="{{asset('storage/' . $foto->imagem)}}" class="d-block w-100" alt="Responsive image">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @else
                <img src="{{asset('assets/img/no-photo.jpg')}}" class="card-img-top" alt="...">
            @endif
        </div>
        <div class="col-6">
            <div>
                <h2>{{$produto->nome}}</h2>
                <p>
                    {{$produto->descricao}}
                </p>

                <h3>R$ {{number_format($produto->preco, '2', ',','.')}}</h3>
                <span>Loja: <a href="{{route('loja.index', ['slug' => $produto->loja->slug])}}">{{$produto->loja->nome}}</a></span>
            </div>
            <hr>
            <div class="produto-add mt-2 col-md-12">
                <form method="POST" action="{{route('carrinho.add')}}">
                    @csrf
                    <input type="hidden" name="produto[nome]" value="{{$produto->nome}}">
                    <input type="hidden" name="produto[preco]" value="{{$produto->preco}}">
                    <input type="hidden" name="produto[slug]" value="{{$produto->slug}}">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-sort-numeric-up"></i></span>
                        </div>
                        <input type="number" name="produto[quantidade]" value="1" class="form-control col-md-2" aria-describedby="addon-wrapping">
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg mt-2">COMPRAR</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            {{$produto->body}}
        </div>
    </div>
@endsection
