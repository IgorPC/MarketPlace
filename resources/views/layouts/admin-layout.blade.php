<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <!-- BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- FIM BOOTSTRAP -->
    <!-- FONT AWSOME -->
    <script src="https://kit.fontawesome.com/35505cabf9.js" crossorigin="anonymous"></script>
    <!-- FIM FONT AWSOME -->
    @yield('stylesheets')
</head>
<body>
<!--<div class="fixed-top">-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><strong style="font-size: 25px">MarketPlace</strong></a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth()<span class="ml-4 mb-2" style="font-size: 35px; color: white">|</span>@endauth
        <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
        @guest()
                <ul class="navbar-nav ml-auto">
                    <div class="form-inline my-2 my-lg-0">
                        <span class="mr-4">
                            <a class="@if(session()->get('carrinho'))btn btn-warning @else btn btn-secondary @endif" href="{{route('carrinho.index')}}">
                                <i class="fas fa-shopping-cart"></i>
                                @if(session()->has('carrinho'))
                                    <span> | {{array_sum(array_column(session()->get('carrinho'), 'quantidade'))}}</span>
                                @endif</a>
                        </span>
                    </div>
                    <li class="nav-item @if(request()->is('login*')) active @endif">
                        <a class="nav-link" href="{{route('login')}}"><strong>Logar</strong><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('register*')) active @endif">
                        <a class="nav-link" href="{{route('register')}}"><strong>Registrar</strong><span class="sr-only">(current)</span></a>
                    </li>
                </ul>
        @endguest
        @auth()
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(!auth()->user()->loja()->exists())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('lojas.create')}}">
                            <strong>Crie sua loja <i class="fas fa-plus"></i></strong>
                        </a>
                    </li>
                </ul>
            @else
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown @if(request()->is('admin*')) active @endif" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <strong>Minha loja <i class="fas fa-store"></i></strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item @if(request()->is('admin/lojas*')) active @endif" href="{{route('lojas.index')}}"><strong>Ver Loja</strong></a>
                        <a class="dropdown-item @if(request()->is('admin/produto*')) active @endif @if(auth()->user()->loja()->count() != 1) disabled @endif" href="{{route('produto.index')}}"><strong>Meus Produtos</strong></a>
                        <a class="dropdown-item @if(request()->is('admin/categorias*')) active @endif @if(auth()->user()->loja()->count() != 1) disabled @endif" href="{{route('categorias.index')}}"><strong>Categorias</strong></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item @if(request()->is('admin/ordens*')) active @endif @if(auth()->user()->loja()->count() != 1) disabled @endif" href="{{route('ordens')}}"><strong>Minhas Vendas</strong></a>
                    </div>
                </li>
            </ul>
            @endif
            <div class="form-inline my-2 my-lg-0">
                @if(auth()->user()->unreadnotifications()->count() != 0)
                <span class="mr-2">
                    <a href="{{route('admin.notificacao')}}" class="btn btn-danger"><strong>{{auth()->user()->unreadnotifications()->count()}} |</strong> <i class="fas fa-envelope"></i></a>
                </span>
                @endif
                <span class="mr-4">
                    <a class="@if(session()->get('carrinho'))btn btn-primary @else btn btn-secondary @endif" href="{{route('carrinho.index')}}">
                        <i class="fas fa-shopping-cart"></i>
                        @if(session()->has('carrinho'))
                            <span> | {{array_sum(array_column(session()->get('carrinho'), 'quantidade'))}}</span>
                        @endif
                    </a>
                </span>
                <span class="mr-4">
                    <button type="button" class="btn btn-warning" id="teste" data-toggle="modal" data-target="#exampleModal">
                      <i class="fas fa-user mr-1"></i> <strong>{{auth()->user()->name}}</strong>
                    </button>
                 </span>
                @include('modal')
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger my-2 my-sm-0"><strong>Sair</strong></button>
                </form>
            </div>
            @endauth
        </div>
    </nav>
<!--</div>-->
    <div class="container" style="margin-top: 1%;margin-bottom: 5%">
        @include('collpse-menu')
        @yield('conteudo')
    </div>
    @yield('script')
</body>
</html>
