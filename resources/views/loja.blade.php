@extends('layouts.admin-layout')

@section('titulo')
  {{$loja->nome}}
@endsection

@section('conteudo')
    <br>
    <div class="row">
        <div class="col-4">
            @if($loja->logo)
                <img src="{{asset('storage/' . $loja->logo)}}" class="card-img-top" alt="">
            @else
                <img src="https://via.placeholder.com/600X420.png?text=LOJA%20SEM%20LOGO" class="card-img-top" alt="Responsive image">
            @endif
        </div>
        <div class="col-8">
            <h2>{{$loja->nome}}</h2>
            <p>{{$loja->descricao}}</p>
            <h4>Contatos: </h4>
            <p><i class="fas fa-phone-square-alt"></i> Telefone: {{$loja->telefone}}</p>
            <p><i class="fab fa-whatsapp-square"></i> Whatsapp: {{$loja->celular}}</p>
            <p><i class="fas fa-envelope-square"></i> Email: {{$loja->email}} </p>
        </div>
    </div>
    <hr>
    <h3>Produtos: </h3>
    <br>
    <div class="row">
    @if($loja->produtos()->count())
        @foreach($loja->produtos as $chave => $produto)
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
                <h4 class="alert-heading">Essa loja está vazia!</h4>
                <p>Acesse nossos produtos clicando no botão abaixo</p>
                <hr>
                <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('home')}}"><i class="fas fa-store"></i> Clique aqui para ser redirecionado aos produtos da loja <i class="fas fa-store"></i></a></p>
            </div>
        </div>
    @endif
@endsection
