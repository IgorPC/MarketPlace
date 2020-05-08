<!-- COLLAPSE MENU -->
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="row mb-2">
                <div class="col-4">
                    <a  href="{{route('home')}}" class="btn btn-primary btn-bg mt-3 ml-2" style="width: 90%; color: black;text-decoration: none"><strong>Produtos </strong><i class="fab fa-product-hunt"></i></a>
                    <a class="btn btn-success btn-bg mt-3 ml-2" data-toggle="collapse" data-target=".multi-collapse" aria-controls="multiCollapseExample1 multiCollapseExample2" style="width: 90%;color: black;text-decoration: none"><strong>Categorias </strong><i class="fas fa-sort"></i></a>
                </div>
                <div class="col-8 mt-3">
                    <h3>Pesquisar:</h3>
                    <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('buscar')}}">
                        @csrf
                        <input class="form-control mr-sm-2" style="width: 85%" name="buscar" type="search" placeholder=" Digite o nome do produto!" aria-label="Search">
                        <button class="btn btn-outline-info my-2 my-sm-0"  type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM COLLAPSE MENU -->
    <!-- COLLAPSE DOS CATEGORIAS -->
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Categorias</h4>
                        <span class="btn btn-danger btn-bg" data-toggle="collapse" data-target=".multi-collapse" aria-controls="multiCollapseExample1 multiCollapseExample2"><strong>X</strong></span>
                    </div>
                    <hr>
                    <ul class="list-group list-group-flush">
                        @foreach($FilterCategorias as $fCategoria)
                            <li class="list-group-item"><a href="{{route('categoria.index', ['slug' => $fCategoria->slug])}}" style="text-decoration: none; color:black">{{$fCategoria->nome}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM COLLAPSE DOS CATEGORIAS -->
