@component('mail::message')
    @component('mail::panel')
        <h1>Olá!</h1>
        Você recebeu um novo pedido!
        <br>
        Clique em ver pedido para acessar sua tela de pedidos
        <br>
        <br>
        <strong>Atenciosamente,
        <br>
        Equipe MarketPlace</strong>
    @endcomponent

    @component('mail::button', ['url' => $url])
        Ver Pedido
    @endcomponent
    <code>.</code>

@endcomponent
