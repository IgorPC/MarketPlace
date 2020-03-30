@extends('layout.admin-layout')

@section('conteudo')
    <h1>Criar Produto</h1>
    <form method="POST">
        @csrf
        <div class="form-group">
            <label>Nome do produto</label>
            <input class="form-control" type="text" name="nomeProduto">
        </div>

        <div class="form-group">
            <label>Conteudo</label>
            <textarea class="form-control" name="body" id="" cols="30" rols="10"></textarea>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control" type="text" name="descricao">
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input class="form-control" type="text" name="preco">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div>

        <div class="form-group">
            <label>Usuario</label>
            <select name="user" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar Produto</button>
        </div>
    </form>
@endsection
