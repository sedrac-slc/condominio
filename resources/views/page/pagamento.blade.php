@extends('layouts.page', ['list' => $pagamentos])
@php $is_membro = isset(Auth::user()->user_membro->id); @endphp
@php $is_morador = isset(Auth::user()->user_morador->id); @endphp
@if ($is_membro)
    @section('buttons')
        <button class="text-primary bg-none" id="btn-add-pagamento" data-bs-toggle="modal" data-bs-target="#modalPagamento"
            url="{{ route('pagamento.create') }}" method="POST">
            <i class="fas fa-user-plus"></i>
            <span>adicionar</span>
        </button>
    @endsection
@endif
@section('thead')
    <th>
        <div><i class="fas fa-home"></i><span>nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>valor</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>mes</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar-times"></i><span>ano</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>descrição</span></div>
    </th>
    @if ($is_membro)
        <th>
            <div><i class="fas fa-bars"></i><span>Para(Confirma)</span></div>
        </th>
    @endif
    <th colspan="2">
        <div><i class="fas fa-users"></i><span>morador</span></div>
    </th>
    @if ($is_membro)
        <th colspan="2">
            <div><i class="fas fa-tools"></i><span>Acções</span></div>
        </th>
    @endif
@endsection
@section('tbody')
    @foreach ($pagamentos as $pagamento)
        <tr>
            <td>{{ $pagamento->nome }}</td>
            <td>{{ $pagamento->valor }}</td>
            <td>{{ $pagamento->mes }}</td>
            <td>{{ $pagamento->ano }}</td>
            <td>{{ $pagamento->descricao }}</td>
            @if ($is_membro)
                <td>
                    <span class="badge bg-danger rounded-circle h5">
                        {{
                            count($pagamento->pagamento_users->filter(function($value){
                                return !isset($value->checked_id);
                            })->all())
                        }}
                    </span>
                </td>
            @endif
            <td>
                <a
                    @if ($is_membro) href="{{ route('pagamento.users', $pagamento->id) }}"
                        class="d-f text-success text-decoration-none"
                    @elseif($is_morador && userMoradorPagementoUser(Auth::user()->user_morador->id, $pagamento->id))
                        href="#"
                        class="d-f text-secondary text-decoration-line-through" @endif>
                    <i class="fas fa-user-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a class="d-f text-info text-decoration-none" href="{{ route('pagamento.user.list', $pagamento->id) }}">
                    <i class="fas fa-user-check"></i>
                    <span>lista</span>
                    <sup>
                        <span class="badge bg-primary rounded-circle h5">{{ $is_membro ? count($pagamento->pagamento_users) : 1 }}</span>
                    </sup>
                </a>
            </td>
            @if ($is_membro)
                <td>
                    <a href="#" class="d-f bg-none text-decoration-none text-danger btn-pagamento-del"
                        data-bs-toggle="modal" data-bs-target="#modalDel"
                        url="{{ route('pagamento.delete', $pagamento->id) }}" method="DELETE">
                        <i class="fas fa-user-times"></i>
                        <span>eliminar</span>
                    </a>
                </td>
                <td>
                    <a href="#" class="d-f bg-none text-decoration-none text-warning btn-pagamento-tr"
                        data-bs-toggle="modal" data-bs-target="#modalPagamento"
                        url="{{ route('pagamento.update', $pagamento->id) }}" method="PUT">
                        <i class="fas fa-user-edit"></i>
                        <span>editar</span>
                    </a>
                </td>
            @endif
        </tr>
    @endforeach
@endsection
@section('modal')
    @if ($is_membro)
        @include('components.modal.pagamento')
        @include('components.modal.delete', [
            'message' => 'Desejas apagar o pagamento',
        ])
    @endif
    @include('components.modal.search', [
        'action' => route('pagamento.search'),
        'default' => 'NOME',
        'method' => 'GET',
        'list' => ['NOME' => 'nome', 'VALOR' => 'valor', 'DESCRICAO' => 'descrição'],
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/pagamento.js') }}"></script>
@endsection
