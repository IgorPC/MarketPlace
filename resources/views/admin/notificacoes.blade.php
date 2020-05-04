@extends('layouts.admin-layout')

@section('titulo')
    Produtos
@endsection

@section('conteudo')
    <br>
    @if($notificacoesNaoLidas->count() != 0)
    <a href="{{route('admin.notificacao.lerTodas')}}" class="btn btn-lg btn-success mb-2 mt-3">Marcar todas como lidas</a>
    <hr>
    <table class="table table-striped mt-2">
        <thead>
            <th>Notificação</th>
            <th>Data</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($notificacoesNaoLidas as $notificacao)
                <tr>
                    <td>{{$notificacao->data['mensagem']}}</td>
                    <td>{{$notificacao->created_at->locale('pt')->diffForHumans()}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('admin.notificacao.lerNotificacao', ['notificacao' => $notificacao->id])}}" class="btn btn-sm btn-warning mr-2"><strong>Marcar como lida</strong> <i class="fas fa-envelope-open"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Você não tem nenhuma notificação!</h4>
            <p>No momento, sua caixa de mensagem está vazia, iremos te informar caso algo aconteça por aqui</p>
            <hr>
            <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('home')}}"><i class="fas fa-store"></i> Clique aqui para ser redirecionado aos produtos da loja <i class="fas fa-store"></i></a></p>
        </div>
    @endif
@endsection
