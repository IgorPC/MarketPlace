<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <script src="https://kit.fontawesome.com/35505cabf9.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">MarketPlace</a>
        @auth()
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/lojas')) active @endif">
                    <a class="nav-link" href="{{route('lojas.index')}}">Lojas <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/produto')) active @endif" href="{{route('produto.index')}}">Produtos</a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <span class="mr-4"><i class="fas fa-user mr-1"></i> {{auth()->user()->name}}</span>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger my-2 my-sm-0">Sair</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>

    <div class="container">
        @yield('conteudo')
    </div>
</body>
</html>
