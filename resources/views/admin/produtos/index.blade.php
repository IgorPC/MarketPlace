@extends('layout.admin-layout')
@section('conteudo')
    <a href="{{route('admin.produto.create')}}" class="btn btn-lg btn-success mb-2 mt-3">Criar Produto</a>

    <table class="table">
        <thead>
            <th>ID</th>
            <th>NOME</th>
            <th>PRECO</th>
            <th>AÇÕES</th>
        </thead>
        <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{$produto->id}}</td>
                <td>{{$produto->nome}}</td>
                <td>{{$produto->preco}}</td>
                <td><a href="/admin/{{$produto->id}}/edit" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a> <a href="/admin/destroy/{{$produto->id}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$produtos->links()}}
@endsection
