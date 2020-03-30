@extends('layout.admin-layout')

@section('conteudo')
    <a href="{{route('admin.loja.store')}}" class="btn btn-lg btn-success mb-2 mt-3">Criar Loja</a>

    @include('layout.mensagem')

    <table class="table">
        <thead>
            <th>ID</th>
            <th>LOJA</th>
            <th>Ações</th>
        </thead>
        <tbody>
        @foreach($lojas as $loja)
            <tr>
                <td>{{$loja->id}}</td>
                <td>{{$loja->nome}}</td>
                <td><a href="/admin/{{$loja->id}}/edit" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a> <a href="/admin/destroy/{{$loja->id}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
            </tr>
        @endforeach
            <tb></tb>
            <tb></tb>
            <tb></tb>
        </tbody>
    </table>

    {{$lojas->links()}}
@endsection

