@extends('layouts.admin-layout')

@section('titulo')
    Obrigado
@endsection

@section('conteudo')
    <h2 class="alert alert-success"> Muito Obrigado pela compra</h2>
    <h3 > Seu pedido foi processado, o codigo é: {{session()->get('ordem')}}</h3>
@endsection
