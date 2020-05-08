function proccessPayment(token) {
    let data ={
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrf
    };

    $.ajax({
        type: 'POST',
        url: urlProcess,
        data: data,
        dataType: 'json',
        success: function (res) {
            toastr.success(res.data.message, 'Sucesso')
            window.location.href = `${urlObrigado}?ordem=${res.data.ordem}`;
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
