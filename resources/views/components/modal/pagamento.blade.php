<div class="modal fade m-2" id="modalPagamento" tabindex="-1" aria-labelledby="modalPagamentoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form id="form-pagamento" class="modal-content bg-white" action="" method="POST">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="modalPagamentoTitle">Adicionar</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Nome:',
                            'icon' => 'fas fa-signature',
                            'type' => 'text',
                            'min' => '1',
                            'name' => 'nome',
                            'placeholder' => 'Digita o nome',
                            'require' => true,
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.input', [
                            'label' => 'Digita o valor:',
                            'icon' => 'fas fa-money-bill',
                            'type' => 'number',
                            'min' => '1',
                            'name' => 'valor',
                            'placeholder' => 'Digita o valor',
                            'require' => true,
                        ])
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        @include('components.input', [
                            'label' => 'Descrição:',
                            'icon' => 'fas fa-comment',
                            'name' => 'descricao',
                            'rows' => '3',
                            'placeholder' => 'Digita uma descrição',
                        ])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">cancelar</button>
                <button type="submit" class="btn btn-outline-primary rounded">confirma</button>
            </div>
        </form>
    </div>
</div>
