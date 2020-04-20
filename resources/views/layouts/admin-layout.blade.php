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
    @yield('stylesheets')
</head>
<body>
<!--<div class="fixed-top">-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{route('home')}}"><strong>MarketPlace</strong></a>
        <!-- Collapse filtros -->
        <p>
            <a class="nav-item btn btn-success btn-sm mt-3" data-toggle="collapse" data-target=".multi-collapse" aria-controls="multiCollapseExample1 multiCollapseExample2"><strong>FILTROS</strong><i class="fas fa-filter"></i></a>
        </p>
        <!-- BOTAO collapse filtros -->
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                            <!-- BODY DO MODAL -->
                            <div class="modal-body">
                                <span id="labelNome"><p>Nome: <strong>{{auth()->user()->name}}</strong></p></span>
                                <!-- IMPUT DE EDICAO -->
                                <div class="input-group input-group-sm mb-3" hidden id="inputNome">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{auth()->user()->name}}">
                                </div>
                                <!-- FIM IMPUT DE EDICAO -->
                                <span id="labelEmail"><p>Email: <strong>{{auth()->user()->email}}</strong></p></span>
                                <!-- IMPUT DE EDICAO -->
                                <div class="input-group input-group-sm mb-3" hidden id="inputEmail">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{auth()->user()->email}}">
                                </div>
                                <!-- FIM IMPUT DE EDICAO -->
                                <span id="labelCelular"><p>Celular: <strong>##############</strong></p></span>
                                <!-- IMPUT DE EDICAO -->
                                <div class="input-group input-group-sm mb-3" hidden id="inputCelular">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Telefone/Celular</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="#">
                                </div>
                                <!-- FIM IMPUT DE EDICAO -->
                                <span id="labelEndereco"><p>Endereço: <strong>##############</strong></p></span>
                                <!-- IMPUT DE EDICAO -->
                                <div class="input-group input-group-sm mb-3" hidden id="inputEndereco">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Endereço</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="#">
                                </div>
                                <!-- FIM IMPUT DE EDICAO -->
                                <span id="labelDoc"><p>CPF/CNPJ: <strong>##############</strong></p></span>
                                <!-- IMPUT DE EDICAO -->
                                <div class="input-group input-group-sm mb-3" hidden id="inputDoc">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">CPF/CNPJ</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="#">
                                </div>
                                <!-- FIM IMPUT DE EDICAO -->
                            </div>
                            <!-- FIM BODY MODAL -->
                            <!-- FOOTER DO MODAL -->
                            <div class="modal-footer">
                                <button type="button" onclick="mostrarEdicao()" class="btn btn-warning"><i class="fas fa-pen"></i> Editar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary">Salvar Alterações</button>
                            </div>
                            <!-- FIM FOOTER MODAL -->
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
<!--</div>-->
<!-- COLLAPSE DOS FILTROS -->
    <div class="container" style="margin-top: 1%;margin-bottom: 5%">
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                       <h4>Categorias</h4>
                        <hr>
                        <ul class="list-group list-group-flush">
                        @foreach($FilterCategorias as $fCategoria)
                                <li class="list-group-item"><a href="#" style="text-decoration: none; color:black">{{$fCategoria->nome}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                        Tipos
                    </div>
                </div>
            </div>
        </div>
        <!-- FIM COLLAPSE DOS FILTROS -->
        @yield('conteudo')
    </div>
    @yield('script')
    <script>
        function mostrarEdicao()
        {
            const nomeLabel = document.getElementById('labelNome');
            const nomeInput = document.getElementById('inputNome');
            const emailLabel = document.getElementById('labelEmail');
            const emailInput = document.getElementById('inputEmail');
            const labelCelular = document.getElementById('labelCelular');
            const inputCelular = document.getElementById('inputCelular');
            const enderecoLabel = document.getElementById('labelEndereco');
            const inputEndereco = document.getElementById('inputEndereco');
            const labelDoc = document.getElementById('labelDoc');
            const inputDoc = document.getElementById('inputDoc');

            if(!nomeLabel.hasAttribute('hidden')){
                nomeLabel.hidden = true;
                nomeInput.removeAttribute('hidden');
                emailLabel.hidden = true;
                emailInput.removeAttribute('hidden');
                labelCelular.hidden = true;
                inputCelular.removeAttribute('hidden');
                enderecoLabel.hidden = true;
                inputEndereco.removeAttribute('hidden');
                labelDoc.hidden = true;
                inputDoc.removeAttribute('hidden');
            }else{
                nomeInput.hidden = true;
                nomeLabel.removeAttribute('hidden');
                emailInput.hidden = true;
                emailLabel.removeAttribute('hidden');
                inputCelular.hidden = true;
                labelCelular.removeAttribute('hidden');
                inputEndereco.hidden = true;
                enderecoLabel.removeAttribute('hidden');
                inputDoc.hidden = true;
                labelDoc.removeAttribute('hidden');
            }
        }
    </script>
</body>
</html>
