<div class="modal fade m-2" id="modalDel" tabindex="-1" aria-labelledby="modalDelTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <form id="form-del" class="modal-content bg-white" action="" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="modalDelTitle">Apagar</h5>
        </div>
        <div class="modal-body">
            <section class="text-center">
                <p>{{$message}}</p>
                <p id="user-name"></p>
            </section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">cancelar</button>
          <button type="submit" class="btn btn-primary">confirma</button>
        </div>
      </form>
    </div>
  </div>
