@extends('layout.admin-layout')

@section('conteudo')
    <a href="{{route('lojas.create')}}" class="btn btn-lg btn-success mb-2 mt-3">Criar Loja</a>

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
                <td>
                    <div class="btn-group">
                        <a href="{{route('lojas.edit', ['loja' => $loja->id])}}" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a>
                        <form action="{{route('lojas.destroy', ['loja' => $loja->id])}}" method="POST">
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

    {{$lojas->links()}}
@endsection

