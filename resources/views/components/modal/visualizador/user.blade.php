<div class="modal fade m-2" id="modalViUser" tabindex="-1" aria-labelledby="modalViUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable">
        <form id="form-user" class="modal-content bg-white" action="" method="POST">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="modalViUserTitle">Visualizar (Úsuario)</h5>
            </div>
            <div class="modal-body">
                <div class="row mt-1">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Nome(completo):',
                            'icon' => 'fas fa-signature',
                            'type' => 'text',
                            'name' => 'user_name',
                            'readonly' => true
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Email:',
                            'icon' => 'fas fa-envelope',
                            'type' => 'email',
                            'name' => 'user_email',
                            'readonly' => true
                        ])
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Gênero:',
                            'icon' => 'fas fa-venus-mars',
                            'name' => 'user_genero',
                            'readonly' => true
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Data nascimento:',
                            'icon' => 'fas fa-calendar',
                            'type' => 'date',
                            'name' => 'user_data_nascimento',
                            'readonly' => true
                        ])
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Telefone:',
                            'icon' => 'fas fa-phone',
                            'type' => 'text',
                            'name' => 'user_telefone',
                            'readonly' => true
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Função:',
                            'icon' => 'fas fa-user-tie',
                            'name' => 'user_funcao',
                            'readonly' => true,
                        ])
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Criação por',
                            'icon' => 'fas fa-calendar',
                            'type' => 'text',
                            'name' => 'user_created',
                            'readonly' => true
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Actualizado por',
                            'icon' => 'fas fa-calendar-check',
                            'name' => 'user_updated',
                            'require' => true,
                            'readonly' => true
                        ])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">cancelar</button>
            </div>
        </form>
    </div>
</div>
