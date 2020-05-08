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
