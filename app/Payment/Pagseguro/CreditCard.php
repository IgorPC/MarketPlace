<?php


namespace App\Payment\Pagseguro;


class CreditCard
{
    private $items;
    private $usuario;
    private $cardinfo;
    private $referencia;

    public function __construct($items, $usuario, $cardinfo, $referencia)
    {
        $this->items = $items;
        $this->usuario = $usuario;
        $this->cardinfo = $cardinfo;
        $this->referencia = $referencia;
    }

    public function fazerPagamento()
    {
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        $creditCard->setReference($this->referencia);

        $creditCard->setCurrency("BRL");

        foreach ($this->items as $cardItem) {

            $creditCard->addItems()->withParameters(
                $this->referencia,
                $cardItem['nome'],
                $cardItem['quantidade'],
                $cardItem['preco']
            );

        }
        $usuario = $this->usuario;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'email@sandbox.pagseguro.com.br' : $usuario->email;
        $creditCard->setSender()->setName($usuario->name);
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '23376641048'
        );

        $creditCard->setSender()->setHash($this->cardinfo['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setToken($this->cardinfo['card_token']);
        list($quantity, $installmentAmount) = explode("|", $this->cardinfo["installment"]);

        $installmentAmount = number_format($installmentAmount, 2, '.', '');

        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($this->cardinfo['card_name']);

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '23376641048'
        );

        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;
    }
}
