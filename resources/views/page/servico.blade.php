@extends('layouts.page', ['list' => $servicos])
@section('buttons')
    <button class="text-primary bg-none" id="btn-add-servico" data-bs-toggle="modal" data-bs-target="#modalServico"
        url="{{ route('servico.create') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@php $is_membro = isset(Auth::user()->user_membro->id); @endphp
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>Descrição</span></div>
    </th>
    @if (!isset($reclamacao))
        <th colspan="2">
            <div><i class="fas fa-home"></i><span>Apartamento</span></div>
        </th>
    @endif
    <th @if ($is_membro) colspan="2" @else colspan="1" @endif>
        <div><i class="fas fa-list"></i><span>Reclamação</span></div>
    </th>
    @if ($is_membro)
        <th>
            <div><i class="fas fa-tools"></i><span>Acções</span></div>
        </th>
    @endif
@endsection
@section('tbody')
    @foreach ($servicos as $servico)
        <tr>
            <td>{{ $servico->nome }}</td>
            <td>{{ $servico->descricao }}</td>
            @if (!isset($reclamacao))
                <td>
                    <a class="d-f text-success text-decoration-none"
                        href="{{ route('servico.apartamento', ['add', $servico->id]) }}">
                        <i class="fas fa-user-plus"></i>
                        <span>adicionar</span>
                    </a>
                </td>
                <td>
                    <a class="d-f text-info text-decoration-none"
                        href="{{ route('servico.apartamento', ['list', $servico->id]) }}">
                        <i class="fas fa-user-check"></i>
                        <span>listar</span>
                        <sup>
                            <span class="badge bg-primary rounded-circle h5">{{ countAgendaServico($servico->id) }}</span>
                        </sup>
                    </a>
                </td>
            @endif
            <td>
                <a class="d-f text-warning text-decoration-none"
                    href="{{ route('servico.apartamento.reclamacao', ['add', $servico->id]) }}{{ isset($reclamacao) ? '?reclamacao=true' : '' }}">
                    <i class="fas fa-user-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            @if ($is_membro)
                <td>
                    <a class="d-f text-primary text-decoration-none"
                        href="{{ route('servico.apartamento.reclamacao', ['list', $servico->id]) }}{{ isset($reclamacao) ? '?reclamacao=true' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>listar</span>
                        <sup>
                            <span
                                class="badge bg-primary rounded-circle h5">{{ countReclamacaoServico($servico->id) }}</span>
                        </sup>
                    </a>
                </td>
            @endif
            @if ($is_membro)
                <td>
                    <a href="#" class="d-f bg-none text-decoration-none text-danger btn-servico-del"
                        data-bs-toggle="modal" data-bs-target="#modalDel" url="{{ route('servico.delete', $servico->id) }}"
                        method="DELETE">
                        <i class="fas fa-user-times"></i>
                        <span>eliminar</span>
                    </a>
                </td>
                <td>
                    <a href="#" class="d-f bg-none text-decoration-none text-warning btn-servico-tr"
                        data-bs-toggle="modal" data-bs-target="#modalServico"
                        url="{{ route('servico.update', $servico->id) }}" method="PUT">
                        <i class="fas fa-user-edit"></i>
                        <span>editar</span>
                    </a>
                </td>
            @endif
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.servico')
    @include('components.modal.search', [
        'action' => route('servico.search'),
        'default' => 'tema',
        'method' => 'GET',
        'list' => ['NOME' => 'Nome', 'DESCRICAO' => 'Descrição'],
    ])
    @include('components.modal.delete', [
        'message' => 'Desejas apagar o serviço ',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/servico.js') }}"></script>
@endsection
