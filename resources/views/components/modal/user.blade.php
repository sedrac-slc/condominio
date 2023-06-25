<div class="modal fade m-2" id="modalUser" tabindex="-1" aria-labelledby="modalUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <form id="form-user" class="modal-content bg-white" action="" method="POST">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="modalUserTitle"></h5>
          @isset($userTypeEnum)
                <div class="" id="type_user">
                    @include('components.select', [
                    'display' => 'Escolha o tipo de utilizador',
                    'label' => 'User(tipo):',
                    'icon' => 'fas fa-users',
                    'name' => 'user_type_perfil',
                    'require' => true,
                    'list' => $userTypeEnum,
                    ])
                </div>
            @endisset
        </div>
        <div class="modal-body">
            <input type="hidden" name="key" id="key"/>
            @include('components.import.user',['user'=>Auth::user()])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">cancelar</button>
          <button type="submit" class="btn btn-primary">confirma</button>
        </div>
      </form>
    </div>
  </div>
