@extends('layouts.admin-layout')

@section('titulo')
    Minhas Vendas
@endsection

@section('conteudo')
    <br>
    <div class="row">
        <div class="col-12">
            <h2>Vendas Realizadas</h2>
            <hr>
        </div>

        <div class="col-12">
            @forelse($ordens as $key => $ordem)
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                Pedido nº {{$ordem->referencia}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul class="list-group">

                                @php $items =  unserialize($ordem->items);@endphp

                                @foreach(filtrarItemsPorLojaId($items, auth()->user()->loja->id) as $item)
                                        <li class="list-group-item">
                                            {{$item['nome']}} |
                                            Quantidade: {{$item['quantidade']}} |
                                            R$ {{number_format($item['preco'], 2, ',', '.')}} |
                                            Total: R$: {{number_format($item['quantidade'] * $item['preco']), 2, '.', ','}}
                                        </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @empty
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Você ainda não realizou nenhuma venda!</h4>
                    <p>Clique no botão abaixo para adicionar seus produtos e começar a vender</p>
                    <hr>
                    <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('produto.index')}}"> Clique aqui para ser redirecionado ao seu menu de produtos</a></p>
                </div>
            @endforelse
                {{$ordens->links()}}

        </div>
    </div>
@endsection
