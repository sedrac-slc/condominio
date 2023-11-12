@extends('layouts.page', ['list' => $reclamacoes])
@section('buttons')
    <div class="d-flex align-item-center g-1 pb-3">
        <a href="{{ $back }}" class="text-decoration-none h5">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
            <span class="pl-2 text-dark">{{ $userMembro->user()->name }}</span>
        </a>
    </div>
    @isset(Auth::user()->user_membro->id)
    <button class="text-primary bg-none" id="btn-add-reclamacao" data-bs-toggle="modal" data-bs-target="#modalReclamacao"
        url="{{ route('reclamacao.create',$userMembro->id) }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
    @endisset
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Motivo</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>Descrição</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($reclamacoes as $reclamacao)
        <tr>
            <td>{{ $reclamacao->motivo }}</td>
            <td>{{ $reclamacao->descricao }}</td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-danger btn-reclamacao-del"
                    data-bs-toggle="modal" data-bs-target="#modalDel"
                    url="{{ route('reclamacao.delete', [$reclamacao->id,$userMembro->id]) }}" user="{{ $userMembro->user()->name }}">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-warning btn-reclamacao-tr"
                    data-bs-toggle="modal" data-bs-target="#modalReclamacao"
                    url="{{ route('reclamacao.update', [$reclamacao->id,$userMembro->id]) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.create', [
        'tite' => 'Confirmação',
        'message' => 'Tens certeza que prentendes efectuar esta acção',
    ])
    @include('components.modal.search', [
        'action' => route('reclamacao.search',$userMembro->id),
        'default' => 'NAME',
        'method' => 'GET',
        'list' => [
            'MOTIVO' => 'Motivo',
            'DESCRICAO' => 'Descrição'
        ],
    ])
    @include('components.modal.delete', [
        'message' => 'Desejas apagar o apartamento ',
    ])
    @include('components.modal.reclamacao')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/reclamacao.js') }}"></script>
@endsection
