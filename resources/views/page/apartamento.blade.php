@extends('layouts.page', ['list' => $apartamentos])
@section('buttons')
    <button class="text-primary bg-none" id="btn-add-apartamento" data-bs-toggle="modal" data-bs-target="#modalApartamanto"
        url="{{ route('user.create') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-home"></i><span>número_casa</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>dimensao</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>descrição</span></div>
    </th>
    <th>
        <div><i class="fas fa-users"></i><span>morador</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($apartamentos as $apartamento)
        <tr>
            <td>{{ $apartamento->num_casa }}</td>
            <td>{{ $apartamento->dimensao }}</td>
            <td>{{ $apartamento->descricao }}</td>
            <td
                @if ($apartamento->isClosed()) class="apartamento-user enfase-modal"
                data-bs-toggle="modal" data-bs-target="#modalViUser"
                url="{{ route('apartamento.api.get.user', $apartamento->id) }}" @endif>
                @if ($apartamento->isClosed())
                    {{ $apartamento->morador()->name }}
                @else
                    <a class="d-f text-success text-decoration-none"
                        href="{{ route('apartamento.users', $apartamento->id) }}">
                        <i class="fas fa-user-plus"></i>
                        <span>adicionar</span>
                    </a>
                @endif
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-danger btn-apartamento-del"
                    data-bs-toggle="modal" data-bs-target="#modalDel"
                    url="{{ route('apartamento.delete', $apartamento->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-warning btn-apartamento-tr"
                    data-bs-toggle="modal" data-bs-target="#modalApartamanto"
                    url="{{ route('apartamento.update', $apartamento->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.apartamento')
    @include('components.modal.search', [
        'action' => route('apartamento.search'),
        'default' => 'NUM_CASA',
        'method' => 'GET',
        'list' => [
            'NUM_CASA' => 'Número da casa',
            'DIMENSAO' => 'Dimensão',
            'DESCRICAO' => 'Descrição',
            'ESTADO' => 'Estado',
        ],
    ])
    @include('components.modal.delete', [
        'message' => 'Desejas apagar o apartamento ',
    ])
    @include('components.modal.visualizador.user')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/apartamento.js') }}"></script>
    <script src="{{ asset('js/visualizador/user.js') }}"></script>
@endsection
