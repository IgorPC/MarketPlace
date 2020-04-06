@extends('layouts.admin-layout')

@section('titulo')
    Lojas
@endsection

@section('conteudo')

    @if($numLoja != 1)
        <a href="{{route('lojas.create')}}" class="btn btn-lg btn-success mb-2 mt-3">Cadastrar Loja</a>
    @endif

    <!-- MENSAGENS PERSONALIZADAS -->
    @include('layouts.mensagens.mensagemVerde')
    @include('layouts.mensagens.mensagemAmarela')
    @include('layouts.mensagens.mensagemVermelha')

    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>LOJA</th>
            <th>Total de produtos</th>
            <th>Ações</th>
        </thead>
        <tbody>
        @foreach($loja as $store)
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->nome}}</td>
                <td>{{$store->produtos->count()}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('lojas.edit', ['loja' => $store->id])}}" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a>
                        <form action="{{route('lojas.destroy', ['loja' => $store->id])}}" method="POST"
                              onsubmit="return confirm('Tem certeza que deseja excluir a loja {{$store->nome}}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
            <tb></tb>
            <tb></tb>
            <tb></tb>
        </tbody>
    </table>
@endsection

