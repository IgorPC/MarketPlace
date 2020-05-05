@extends('layouts.admin-layout')

@section('titulo')
    Atualizar Produto
@endsection

@section('conteudo')
    <h1 mt-4>Atualizar Produto</h1>
    <div class="mt-4">
        <form method="POST" action="{{route('produto.update',['produto' => $produto->id])}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 47px;" id="inputGroup-sizing-default"><strong>Nome</strong></span>
                </div>
                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$produto->nome}}">
                @error('nome')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 19px;" id="inputGroup-sizing-default"><strong>Conteudo</strong></span>
                </div>
                <input type="text" name="body" class="form-control @error('body') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$produto->body}}">
                @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 19px;" id="inputGroup-sizing-default"><strong>Descrição</strong></span>
                </div>
                <input type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$produto->descricao}}">
                @error('descricao')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 49px;" id="inputGroup-sizing-default"><strong>Preço</strong></span>
                </div>
                <input type="text" name="preco" class="form-control @error('preco') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$produto->preco}}">
                @error('preco')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01"><strong>Categorias</strong></label>
                </div>
                <select name="categorias[]" class="custom-select" id="inputGroupSelect01" multiple required>
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}" @if($produto->categoria->contains($categoria)) selected @endif>{{$categoria->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Adicionar fotos para o produto</label>
                <input type="file" name="fotos[]" multiple class="form-control"  style="height: 20%">
            </div>

            <div>
                <button type="submit" class="btn btn-lg btn-warning mb-4">Atualizar Produto</button>
            </div>
        </form>

        <div class="row">
            @foreach($produto->fotos as $foto)
                <div class="col-6 text-center mt-1">
                    <div class="form-group">
                        <img class="img-fluid" src="{{asset('storage/' . $foto->imagem)}}">
                        <form action="{{route('removerFoto')}}" method="POST">
                            @csrf
                            <input name="nomeFoto" type="hidden" value="{{$foto->imagem}}">
                            <button type="submit" class="btn btn-lg btn-danger mt-1">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#preco').maskMoney({prefix: 'R$', allowNegative: false, thousands: '.', decimal: ','});
    </script>
@endsection
