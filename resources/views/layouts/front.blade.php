<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/lojas*')) active @endif">
                    <a class="nav-link" href="{{route('lojas.index')}}">Lojas <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(request()->is('admin/produto*')) active @endif">
                    <a class="nav-link" href="{{route('produto.index')}}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/*')) active @endif">
                    <a class="nav-link" href="{{route('categorias.index')}}">Categorias</a>
                </li>
            </ul>

            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault();
                                                                  document.querySelector('form.logout').submit(); ">Sair</a>

                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">{{auth()->user()->name}}</span>
                    </li>
                </ul>
            </div>
        @endauth

    </div>
</nav>

<div class="container">
    @yield('conteudo')
</div>
</body>
</html>

