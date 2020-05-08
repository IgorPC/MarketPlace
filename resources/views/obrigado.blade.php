@extends('layouts.admin-layout')

@section('titulo')
    Obrigado
@endsection

@section('conteudo')
    <br>
    <h2 class="alert alert-success"> Muito Obrigado pela compra</h2>
    <h3 > Seu pedido foi processado, o codigo é: {{request()->get('ordem')}}</h3>
@endsection
