<div class="modal fade m-2" id="modalApartamanto" tabindex="-1" aria-labelledby="modalApartamantoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <form id="form-reuniao" class="modal-content bg-white" action="" method="POST">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="modalReuniaoTitle">Adicionar</h5>
        </div>
        <div class="modal-body">
            <div class="row mt-1">
                <div class="col-md-12">
                    @include('components.input',[
                        'label' => 'Digita o tema:',
                        'icon' => 'fas fa-signature',
                        'name' => 'tema',
                        'placeholder' => 'Digita o tema',
                        'require' => true
                    ])
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    @include('components.input',[
                        'label' => 'Data:',
                        'icon' => 'fas fa-calendar',
                        'name' => 'data',
                        'type' => 'date',
                        'placeholder' => 'Digita a data:',
                        'require' => true,
                    ])
                </div>
                <div class="col-md-6">
                    @include('components.input',[
                        'label' => 'Hora começo:',
                        'icon' => 'fas fa-clock',
                        'name' => 'hora_comeco',
                        'type' => 'time',
                        'placeholder' => 'Digita a hora:',
                        'require' => true,
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
