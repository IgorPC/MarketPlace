@extends('layouts.admin-layout')

@section('titulo')
    Home
@endsection

@section('conteudo')
    <div class="row">
    @foreach($produtos as $chave => $produto)
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
    </div>
@endsection
