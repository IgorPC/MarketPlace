@extends('layouts.admin-layout')

@section('titulo')
    Categorias
@endsection

@section('conteudo')

    <a href="{{route('categorias.create')}}" class="btn btn-lg btn-success mb-2 mt-3">Cadastrar categoria <i class="fas fa-plus"></i></a>

    <!-- MENSAGENS PERSONALIZADAS -->
    @include('layouts.mensagens.mensagemVerde')
    @include('layouts.mensagens.mensagemAmarela')
    @include('layouts.mensagens.mensagemVermelha')

    <table class="table table-striped mt-2">
        <thead>
        <th>ID</th>
        <th>Categoria</th>
        <th>Ações</th>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->nome}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('categorias.edit', ['categoria' => $categoria->id])}}" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a>
                        <form action="{{route('categorias.destroy', ['categoria' => $categoria->id])}}" method="POST"
                              onsubmit="return confirm('Tem certeza que deseja excluir a categoria {{$categoria->nome}}?')">
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

    {{$categorias->links()}}
@endsection

