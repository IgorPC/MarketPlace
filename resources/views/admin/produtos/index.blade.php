@extends('layouts.admin-layout')

@section('titulo')
    Produtos
@endsection

@section('conteudo')

    <a href="{{route('produto.create')}}" class="btn btn-lg btn-success mb-2 mt-3">Cadastrar Produto</a>

    <!-- MENSAGENS PERSONALIZADAS -->
    @include('layouts.mensagens.mensagemVerde')
    @include('layouts.mensagens.mensagemAmarela')
    @include('layouts.mensagens.mensagemVermelha')

    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>NOME</th>
            <th>PRECO</th>
            <th>Loja</th>
            <th>AÇÕES</th>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>R$ {{$produto->preco}}</td>
                    <td>{{$produto->loja->nome}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="/admin/produto/{{$produto->id}}/edit" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a>
                            <form action="{{route('produto.destroy', ['produto' => $produto->id])}}" method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja excluir o produto {{$produto->nome}}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{$produtos->links()}}
@endsection
