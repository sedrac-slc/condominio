<div class="modal fade m-2" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateTitle" aria-hidden="true">
    <div class="modal-dialog @isset($model) @else  modal-sm @endisset">
      <form id="form-create" class="modal-content bg-white" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateTitle">{{$tite}}</h5>
        </div>
        <div class="modal-body">
            <section class="text-center @isset($justify) t-j @endisset">
                <p>{{$message}}</p>
                <p id="user-name"></p>
            </section>
            @isset($comprovativo)
                <div>
                    <label class="form-label">Insira o comprovativo</label>
                    <input class="form-control" name="file" type="file"/>
                </div>
            @endisset
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">cancelar</button>
          <button type="submit" class="btn btn-outline-primary rounded">confirma</button>
        </div>
      </form>
    </div>
  </div>
