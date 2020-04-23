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
        PagSeguroDirectPayment.setSessionId(sessionId);

        let amountTransaction = '{{$cardItens}}';
        let numero_cartao = document.querySelector('input[name=numero_cartao]');
        let spanBrand = document.querySelector('span.brand');
        numero_cartao.addEventListener('keyup', function () {
            if(numero_cartao.value.length >= 6){
                PagSeguroDirectPayment.getBrand({
                    cardBin: numero_cartao.value.substr(0, 6),
                    success: function (res) {
                        let imgFlag = `<label class="mb-1"><strong>Bandeira</strong></label> <br> <img class="img-thumbnail" src= "https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;
                        spanBrand.innerHTML = imgFlag;
                        document.querySelector('input[name=cardBrand]').value = res.brand.name;
                        getInstallments(amountTransaction, res.brand.name);
                    },
                    error: function (err) {
                        console.log(err)
                    },
                    //complete: function (res) {
                        //console.log('Complete ', res);
                    //}
                });
            }
        });

        let submitButtom = document.querySelector('button.processCheckout');

        submitButtom.addEventListener('click', function(event) {
            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=numero_cartao]').value,
                brand: document.querySelector('input[name=cardBrand]').value,
                cvv: document.querySelector('input[name=codigo_segurança]').value,
                expirationMonth: document.querySelector('input[name=mes_vencimento]').value,
                expirationYear: document.querySelector('input[name=ano_vencimento]').value,
                success: function (res) {
                    proccessPayment(res.card.token);
                }
            });
        });

        function proccessPayment(token) {
            let data ={
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'
            };

            $.ajax({
                type: 'POST',
                url: '{{route('checkout.proccess')}}',
                data: data,
                dataType: 'json',
                success: function (res) {
                    toastr.success(res.data.message, 'Sucesso')
                    //window.location.href = '{{route('checkout.obrigado')}}?ordem=' + res.data.ordem;
                }
            });
        }

        function  getInstallments(amount, brand) {
            PagSeguroDirectPayment.getInstallments({
                amount:amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function (res) {
                    let selectInstallments =  drawSelectInstallments(res.installments[brand]);
                    document.querySelector('div.installments').innerHTML = selectInstallments;
                },
                error: function (error) {

                },
                complete: function (res) {

                },
            })
        }

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select_installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica R$ ${l.totalAmount}</option>`;
            }


            select += '</select>';

            return select;
        }
    </script>
@endsection
