@extends('layouts.admin-layout')

@section('titulo')
    Checkout
@endsection

@section('conteudo')
    <div class="container">
        <h1>Pagamento: </h1>
        <hr>
        <form action="#" method="POST">
            <div class="row">
                <div class="col-md-8 form-group">
                    <label>Numero do cartão:</label>
                    <input class="form-control" type="text" name="numero_cartão">
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 form-group">
                    <label>Mes de vencimento: </label>
                    <input class="form-control" type="text" name="mes_vencimento">
                </div>
                <div class="col-md-2 form-group">
                    <label>Ano de vencimento: </label>
                    <input class="form-control" type="text" name="ano_vencimento">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Codigo de segurança:</label>
                    <input class="form-control" type="text" name="codigo_segurança">
                </div>
            </div>

            <button class="btn btn-success btn-lg">Efetuar Pagamento</button>
        </form>
    </div>
@endsection
