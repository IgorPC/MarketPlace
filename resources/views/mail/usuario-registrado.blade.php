<h1>Olá, {{$user->name}}</h1>
<h2>Obrigado por se registrar em nosso MarketPlace</h2>

<p>Esperamos que goste da nossa plataforma e estamos a disposição para ajuda-lo no que for necessario</p>
<p>Gostaria de informar que esta é uma plataforma não oficial, ou seja, é um projeto desenvolvido para um portfolio, os dadaos e produtos encontrados aqui são ficticios!</p>

<p>Seu email de cadastro é: <strong>{{$user->email}}</strong></p>
<hr>
Email enviado em: {{date('d/m/Y H:i:s')}}
<p>Equipe MarketPlace</p>
