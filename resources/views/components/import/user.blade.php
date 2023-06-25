<div class="row border-bottom border-dark pb-2" id="password-input">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Senha:',
            'icon' => 'fas fa-lock',
            'type' => 'password',
            'name' => 'password',
            'placeholder' => 'Digita a sua senha',
            'require' => true,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Confirma(senha):',
            'icon' => 'fas fa-key',
            'type' => 'password',
            'name' => 'password_confirmation',
            'placeholder' => 'Confirma a sua senha',
            'require' => true,
        ])
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Nome(completo):',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'name',
            'placeholder' => 'Digita o seu nome completo',
            'require' => true,
            'value' => $user->name ?? '',
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Email:',
            'icon' => 'fas fa-envelope',
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'Digita o seu email',
            'require' => true,
            'value' => $user->email ?? '',
        ])
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        @include('components.select', [
            'label' => 'Gênero:',
            'icon' => 'fas fa-venus-mars',
            'name' => 'genero',
            'require' => true,
            'list' => ['MASCULINO' => 'Masculino', 'FEMENINO' => 'Femenino'],
            'init' => $user->genero ?? '',
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Data nascimento:',
            'icon' => 'fas fa-calendar',
            'type' => 'date',
            'name' => 'data_nascimento',
            'placeholder' => 'Digita a sua data',
            'require' => true,
            'value' => $user->data_nascimento ?? '',
        ])
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Telefone:',
            'icon' => 'fas fa-phone',
            'type' => 'text',
            'name' => 'telefone',
            'placeholder' => 'Digita o seu telefone',
            'require' => true,
            'value' => $user->telefone ?? '',
        ])
    </div>
    @isset($funcaoEnum)
        <div class="col-md-6 component-membro">
            @include('components.select', [
                'label' => 'função:',
                'icon' => 'fas fa-user-tie',
                'name' => 'funcao',
                'list' => $funcaoEnum,
                'default' => $user->rulesToString() ?? ""
            ])
        </div>
    @endisset
</div>
