<div class="modal fade m-2" id="modalViApartamento" tabindex="-1" aria-labelledby="modalViApartamentoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content bg-white">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="modalViApartamentoTitle">Visualizar (Apartamento)</h5>
            </div>
            <div class="modal-body">
                <div class="row mt-1">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Número da casa',
                            'icon' => 'fas fa-signature',
                            'type' => 'number',
                            'name' => 'apartamento_num_casa',
                            'readonly' => true
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Dimensão',
                            'icon' => 'fas fa-envelope',
                            'name' => 'apartamento_dimensao',
                            'require' => true,
                            'readonly' => true
                        ])
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        @include('components.input', [
                            'label' => 'Descrição',
                            'icon' => 'fas fa-comment',
                            'name' => 'apartamento_descricao',
                            'readonly' => true
                        ])
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Criação por',
                            'icon' => 'fas fa-calendar',
                            'type' => 'text',
                            'name' => 'apartamento_created',
                            'readonly' => true
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Actualizado por',
                            'icon' => 'fas fa-calendar-check',
                            'name' => 'apartamento_updated',
                            'require' => true,
                            'readonly' => true
                        ])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">cancelar</button>
            </div>
        </div>
    </div>
</div>
