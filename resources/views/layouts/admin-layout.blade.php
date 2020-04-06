<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <!-- BOOTSTRAP -->
    <script src="https://kit.fontawesome.com/35505cabf9.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- FIM BOOTSTRAP -->
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><strong>MarketPlace</strong></a>
        @auth()
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/lojas*')) active @endif">
                    <a class="nav-link" href="{{route('lojas.index')}}"><strong>Lojas</strong><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/produto*')) active @endif @if(auth()->user()->loja()->count() != 1) disabled @endif" href="{{route('produto.index')}}"><strong>Produtos</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/categorias*')) active @endif" href="{{route('categorias.index')}}"><strong>Categorias</strong></a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <span class="mr-4">
                    <button type="button" class="btn btn-warning" id="teste" data-toggle="modal" data-target="#exampleModal">
                      <i class="fas fa-user mr-1"></i> <strong>{{auth()->user()->name}}</strong>
                    </button>
                 </span>
                <!-- MODAL DADOS DO USUARIO -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Dados do Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Nome: <span id="mostrarUsuario"><strong>{{auth()->user()->name}}</strong></span></p>
                                <p>Email: <strong>{{auth()->user()->email}}</strong></p>
                                <p>Telefone/Celular: <strong></strong></p>
                                <p>Endereço: <strong></strong></p>
                                <p>CPF/CNPJ: <strong></strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning disabled"><i class="fas fa-pen"></i> Editar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary">Salvar Alterações</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM MODAL DADOS DO USUARIO -->
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger my-2 my-sm-0"><strong>Sair</strong></button>
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
