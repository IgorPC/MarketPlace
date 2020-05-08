@extends('layouts.admin-layout')

@section('titulo')
    Checkout
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" class="hel">
@endsection

@section('conteudo')
    <br>
    <div class="container">
        <h1>Pagamento: </h1>
        <hr>
        <form action="#">
            <div class="row">
                <div class="col-md-8 form-group">
                    <label>Nome do titular do cartão: </label>
                    <input class="form-control" type="text" name="card_name">
                </div>
                <div class="col-md-8 form-group">
                    <label>Numero do cartão: </label>
                    <input class="form-control" type="text" name="numero_cartao">
                    <input type="hidden" name="cardBrand">
                </div>
                <div>
                    <span class="brand"></span>
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
                <div class="col-md-4 installments form-group">
                </div>
            </div>

            <button class="btn btn-success btn-lg processCheckout">Efetuar Pagamento</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';

        const urlObrigado = '{{route('checkout.obrigado')}}';
        const urlProcess = '{{route('checkout.proccess')}}';
        const urlPedido = '{{route('ordens.pedidos')}}';
        const csrf = '{{csrf_token()}}'

        let amountTransaction = '{{$cardItens}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script src="{{asset('js/pagseguro_funcoes.js')}}"></script>
    <script src="{{asset('js/pagseguro_eventos.js')}}"></script>
@endsection
