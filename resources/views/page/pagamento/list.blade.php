@extends('layouts.page', ['list' => $users])
@php $is_membro = isset(Auth::user()->user_membro->id); @endphp
@section('buttons')
    <div class="d-flex align-item-center g-1">
        <a href="{{ route('pagamento.home') }}" class="text-decoration-none h5">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
        <h5 class=""> <span>Pagamento:</span> {{ $pagamento->nome }} </h5>
    </div>
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
        <div><i class="fas fa-calendar"></i><span>Data nascimento</span></div>
    </th>
    <th>
        <div><i class="fas fa-file"></i><span>Comprovativo</span></div>
    </th>
    <th>
        <div><i class="fas fa-tools"></i><span>Confirmado(Por)</span></div>
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
            <td>
                <a href="{{ url("storage/{$user->file}") }}" class="d-f bg-none text-decoration-none text-warning">
                    <i class="fas fa-eye"></i>
                    <span>visualizar</span>
                </a>
            </td>
            <td>
                @isset($user->checked_id)
                    {{ userMembro($user->checked_id)->name ?? '-' }}
                @else
                    @if ($is_membro)
                        <button type="button" class="bg-none text-success rounded text-center btn-create"
                            data-bs-toggle="modal" data-bs-target="#modalCreate"
                            url="{{ route('pagamento.users.confirm', [$user->pagamento_user_id]) }}">
                            <i class="fas fa-check-square text-"></i>
                            <span>confirma</span>
                        </button>
                    @else
                        Não confirmado
                    @endif
                @endisset
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @if ($is_membro)
        @include('components.modal.create', [
            'tite' => 'Confirmação',
            'message' => 'Tens certeza que prentendes fazer a confirmação deste pagamento',
        ])
    @endif
    @include('components.modal.search', [
        'action' => route('pagamento.users.search', $pagamento->id),
        'default' => 'NAME',
        'method' => 'GET',
        'list' => [
            'NAME' => 'Nome',
            'EMAIL' => 'Email',
            'GENERO' => 'Género',
            'TELEFONE' => 'Telefone',
            'DATA_NASCIMENTO' => 'Data nascimento',
        ],
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/apartamento_user.js') }}"></script>
@endsection
