<div class="modal fade" id="modalSearch" tabindex="-1" aria-labelledby="modalSearchTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form id="form-search" class="modal-content bg-white" action="{{ $action }}" method="{{ $method_form ?? "GET" }}">
        @csrf
        @method($method ?? "GET")
        <div class="modal-header">
          <h5 class="modal-title" id="modalSearchTitle">Pesquisar registo</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    @include('components.select',[
                        'label' => 'Campo:',
                        'icon' => 'fas fa-tools',
                        'name' => 'field',
                        'require' => true,
                        'init' => $default,
                        'list' => $list,
                    ])
                </div>
                <div class="col-md-8">
                    @include('components.input', [
                        'label' => 'Digita o que desejas?',
                        'icon' => 'fas fa-user',
                        'type' => 'search',
                        'name' => 'search',
                        'placeholder' => 'digita aqui',
                        'require' => true,
                    ])
                </div>
            </div>
        </div>
        @if (isset($mult) && $mult)
            <input type="hidden" name="type" value="plus"/>
        @endif
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">cancelar</button>
          <button type="submit" class="btn btn-outline-primary rounded">confirma</button>
        </div>
      </form>
    </div>
  </div>
