<div class="modal fade m-2" id="modalApartamanto" tabindex="-1" aria-labelledby="modalApartamantoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <form id="form-apartamento" class="modal-content bg-white" action="" method="POST">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="modalApartamantoTitle">Adicionar</h5>
        </div>
        <div class="modal-body">
            <div class="row mt-1">
                <div class="col-md-6">
                    @include('components.input',[
                        'label' => 'Número da casa:',
                        'icon' => 'fas fa-signature',
                        'type' => 'number',
                        'min' => '1',
                        'name' => 'num_casa',
                        'placeholder' => 'Digita o número da casa',
                        'require' => true
                    ])
                </div>
                <div class="col-md-6">
                    @include('components.input',[
                        'label' => 'Dimensão:',
                        'icon' => 'fas fa-envelope',
                        'name' => 'dimensao',
                        'placeholder' => 'Digita a dimensão da casa',
                        'require' => true,
                    ])
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12">
                @include('components.input',[
                    'label' => 'Descrição:',
                    'icon' => 'fas fa-comment',
                    'name' => 'descricao',
                    'rows' => '3',
                    'placeholder' => 'Digita uma descrição'
                ])
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">cancelar</button>
          <button type="submit" class="btn btn-primary">confirma</button>
        </div>
      </form>
    </div>
  </div>
