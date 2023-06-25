
<input type="hidden" name="user_membro_id" id="user_membro_id"
    @isset($userMembro->id)
        value="{{ $userMembro->id }}"
    @endisset
/>

<div class="row">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Motivo da sua reclamação:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'min' => '1',
            'name' => 'motivo',
            'placeholder' => 'Digita o motivo',
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
