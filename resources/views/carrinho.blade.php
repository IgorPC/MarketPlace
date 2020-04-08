@extends('layouts.admin-layout')

@section('titulo')
    Carrinho de Compras
@endsection

@section('conteudo')

    <div class="row mt-4">
        <div class="col-12">
            <h2>Carrinho de compras</h2>
            <hr>
        </div>
        <div class="col-12">
            @if($carrinho)
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Sub-Total</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                    @php $total = 0; @endphp

                    @foreach($carrinho as $car)
                    <tr>
                        <td>{{$car['nome']}}</td>
                        <td>R$ {{number_format($car['preco'], '2',',', '.')}}</td>
                        <td>{{$car['quantidade']}}</td>
                        @php
                            $subtotal = $car['preco'] * $car['quantidade'];
                            $total += $subtotal;
                        @endphp
                        <td>R$ {{number_format(($car['preco']*$car['quantidade']), '2',',', '.')}}</td>
                        <td><a class="btn btn-danger btn-sm" href="{{route('carrinho.remover', ['slug' => $car['slug']])}}">X</a></td>
                    </tr>
                    @endforeach
                    <tr class="bg-success">
                        <td colspan="2"></td>
                        <td><strong>Total</strong></td>
                        <td><strong>R$ {{number_format($total, '2',',', '.')}}</strong></td>
                        <td colspan="1"></td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <div class="col-md-12">
                    <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success float-right">Concluir Compra</a>
                    <a href="{{route('carrinho.cancelar')}}" class="btn btn-lg btn-danger float-left">Cancelar Compra</a>
                </div>
            @else
                @include('layouts.mensagens.mensagemVermelha')
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Carrinho Vazio!</h4>
                    <p>No momento seu carrinho está vazio, mas não precisamos continuar assim, acesse os produtos da loja clicando no link abaixo.</p>
                    <hr>
                    <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('home')}}"><i class="fas fa-store"></i> Clique aqui para ser redirecionado aos produtos da loja <i class="fas fa-store"></i></a></p>
                </div>
            @endif
        </div>
    </div>

@endsection
