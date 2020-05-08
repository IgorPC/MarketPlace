<!-- MODAL DADOS DO USUARIO -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados do Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- BODY DO MODAL -->
            <div class="modal-body">
                <span id="labelNome"><p>Nome: <strong>{{auth()->user()->name}}</strong></p></span>
                <span id="labelEmail"><p>Email: <strong>{{auth()->user()->email}}</strong></p></span>
                @if(auth()->user()->verify_cod == 0)
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Seus dados estão incompletos!</h4>
                        <p>Clique no botão abaixo para finalizar seu cadastro</p>
                        <hr>
                        <p class="mb-0 text-center"><a class="btn btn-success" href="{{route('usuario.editar')}}"><i class="fas fa-user"></i> Clique aqui para editar os dados <i class="fas fa-user"></i></a></p>
                    </div>
                @else
                    <span id="labelCelular"><p>Celular: <strong>{{auth()->user()->celphone}}</strong></p></span>
                    <span id="labelEndereco"><p>Endereço: <strong>{{auth()->user()->street}}, {{auth()->user()->number}}, {{auth()->user()->city}} - {{auth()->user()->state}}</strong></p></span>
                    <span id="labelDoc"><p>CPF/CNPJ: <strong>{{auth()->user()->doc}}</strong></p></span>
                @endif
            </div>
            <!-- FIM BODY MODAL -->
            <!-- FOOTER DO MODAL -->
            <div class="modal-footer">
                <a class="btn btn-success" href="{{route('ordens.pedidos')}}">Meus Pedidos</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="{{route('usuario.editar')}}" class="btn btn-primary"><i class="fas fa-pen"></i> Editar</a>
            </div>
            <!-- FIM FOOTER MODAL -->
        </div>
    </div>
</div>
<!-- FIM MODAL DADOS DO USUARIO -->
