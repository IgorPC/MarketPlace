@extends('layouts.admin-layout')

@section('titulo')
    {{auth()->user()->name}}
@endsection

@section('conteudo')
    <br>
    @include('layouts.mensagens.mensagemVerde')
    <div class="col-md-12">
        <h2>Dados de cadastro</h2>
        <hr>
    </div>
    <form action="{{route('usuario.editar.dados', ['id'=> auth()->user()->id])}}" method="POST">
        @csrf
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="padding-right: 16px;" id="inputGroup-sizing-default"><strong>Nome</strong></span>
                        </div>
                        <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control @error('name') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="padding-right: 6px;" id="inputGroup-sizing-default"><strong>CPF/CNPJ</strong></span>
                        </div>
                        <input type="text" name="doc" value="{{auth()->user()->doc}}" class="form-control @error('doc') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        @error('doc')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 10px;" id="inputGroup-sizing-default"><strong>Celular</strong></span>
                    </div>
                    <input type="text" name="celphone" value="{{auth()->user()->celphone}}" class="form-control @error('celphone') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('celphone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 15px;" id="inputGroup-sizing-default"><strong>Telefone</strong></span>
                    </div>
                    <input type="text" name="phone" value="{{auth()->user()->phone}}" class="form-control @error('phone') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 28px;" id="inputGroup-sizing-default"><strong>Rua</strong></span>
                    </div>
                    <input type="text" name="street" value="{{auth()->user()->street}}" class="form-control @error('street') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('street')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 10px;" id="inputGroup-sizing-default"><strong>Numero</strong></span>
                    </div>
                    <input type="text" name="number" value="{{auth()->user()->number}}" class="form-control @error('number') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('number')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 8px;" id="inputGroup-sizing-default"><strong>Bairro</strong></span>
                    </div>
                    <input type="text" name="district" value="{{auth()->user()->district}}" class="form-control @error('district') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('district')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 9px;" id="inputGroup-sizing-default"><strong>Cidade</strong></span>
                    </div>
                    <input type="text" name="city" value="{{auth()->user()->city}}" class="form-control @error('city') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('city')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 18px;" id="inputGroup-sizing-default"><strong>Estado</strong></span>
                    </div>
                    <select class="custom-select" name="state" id="inputGroupSelect01">
                        <option selected value="{{auth()->user()->state}}"><strong>{{auth()->user()->state}}</strong></option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espirito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    @error('state')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 20px;" id="inputGroup-sizing-default"><strong>País</strong></span>
                    </div>
                    <input type="text" name="country" value="@if(is_null(auth()->user()->country))Brasil @else {{auth()->user()->country}}  @endif" class="form-control @error('country') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('country')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 28px;" id="inputGroup-sizing-default"><strong>CEP</strong></span>
                    </div>
                    <input type="text" name="postalcode" value="{{auth()->user()->postalcode}}" class="form-control @error('postalcode') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    @error('postalcode')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding-right: 10px;" id="inputGroup-sizing-default"><strong>Complemento</strong></span>
                    </div>
                    <input type="text" name="complement" value="{{auth()->user()->complement}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
        </div>
        <hr>
        <button class="btn btn-success btn-lg">Salvar dados</button>
    </form>
@endsection
