@extends('layouts.page', ['list' => $users])
@section('page-container')
    <p class="d-none" id="user-data" hidden
        data-name="{{ $auth->name }}"
        data-email="{{ $auth->email }}"
        data-telefone="{{ $auth->telefone }}"
        data-genero="{{ $auth->genero }}"
        data-data_nascimento="{{ $auth->data_nascimento }}"
    >
    </p>
    @isset($auth->user_membro)
        <p class="d-none" id="membro-funcao" data-funcao="{{ $auth->user_membro->funcao }}" hidden></p>
    @endisset
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}"/>
@endsection
@section('buttons')
    <button class="text-primary bg-none" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalUser"
        url="{{ route('user.create') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
    <button class="text-success bg-none" id="btn-up-user" data-bs-toggle="modal" data-bs-target="#modalUser"
        url="{{ route('user.update') }}" method="PUT">
        <i class="fas fa-user-edit"></i>
        <span>actualizar</span>
    </button>
    <button class="text-info bg-none" id="btn-del-user" data-bs-toggle="modal" data-bs-target="#modalDel"
        url="{{ route('user.delete') }}">
        <i class="fas fa-user-times"></i>
        <span>eliminar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>Email</span></div>
    </th>
    <th>
        <div><i class="fas fa-venus-mars"></i><span>Gênero</span></div>
    </th>
    <th>
        <div><i class="fas fa-phone"></i><span>Telefone</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>Data_nascimento</span></div>
    </th>
    <th>
        <div><i class="fas fa-user-tie"></i><span>Tipo</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->genero }}</td>
            <td>{{ $user->telefone }}</td>
            <td>{{ $user->data_nascimento }}</td>
            <td @if($user->isMoradorResidente())
                    class="morador-residente enfase-modal"
                    url="{{ route('user.api.get.apartamento', $user->id)}}"
                    data-bs-toggle="modal" data-bs-target="#modalViApartamento"
                @endif>
                {{ $user->rulesToString() }}
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-danger btn-user-del" data-bs-toggle="modal"
                    data-bs-target="#modalDel" url="{{ route('user.delete.other', $user->id) }}"
                    user="{{ $user->name }}">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-warning btn-user-tr" data-bs-toggle="modal"
                    data-bs-target="#modalUser" url="{{ route('user.update.other', $user->id) }}" method="PUT"
                    type-user="{{ $user->isMembro()? "membro" : "morador" }}"
                    @if($user->isMembro()) data-funcao="{{ $user->user_membro->funcao  }}" @endif>
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.user')
    @include('components.modal.search',[
        'action' => route('user.search'),
        'default' => "NAME",
        'method' => 'GET',
        'list' => ["NAME"=>"Nome","EMAIL"=>"Email","GENERO"=>"Género","TELEFONE"=>"Telefone","DATA_NASCIMENTO"=>"Data nascimento"]
    ])
    @include('components.modal.delete', [
        'message' => 'Desejas continuar com esta operação eliminando o usuário ',
    ])
    {{-- @include('components.modal.visualizador.apartamento') --}}
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/home.js') }}"></script>
    {{-- <script src="{{ asset('js/visualizador/apartamento.js') }}"></script> --}}
@endsection
