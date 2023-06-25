@extends('layouts.page', ['list' => $users])
@section('buttons')
    <div class="d-flex align-item-center g-1">
        <a href="{{ route('reuniao.home') }}" class="text-decoration-none h5">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
        <h5 class=""> <span>Reunião:</span> {{ $reuniao->tema }} </h5>
    </div>
@endsection
@if (isset($mult))
    @section('form-open')
        <form action="{{ route('notificar.users.mult',$reuniao->id) }}" method="POST">
            @csrf
    @endsection
@endif
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
    <th>
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
            <td>{{ rulesOfString($user->id) }}</td>
            <td>
                @if (!isset($mult))
                    <button type="button" class="bg-none text-secondary rounded text-center btn-create"
                        data-bs-toggle="modal" data-bs-target="#modalCreate"
                        url="{{ route('reuniao.notificar.store', [$reuniao->id, $user->id]) }}">
                        <i class="fas fa-check-square text-success"></i>
                        <span>escolher</span>
                    </button>
                @else
                    <div class="d-flex">
                        <input type="checkbox" id="inpt_user_{{$loop->index}}" class="form-check" name="users[]" value="{{ $user->id }}">
                        <label class="form-label pl-2" for="inpt_user_{{$loop->index}}">escolher</label>
                    </div>
                @endif
            </td>
        </tr>
    @endforeach
@endsection
@if (isset($mult))
    @section('form-end')
            <button class="btn btn-primary m-3 rounded">
                <i class="fas fa-save"></i>
                <span>Notificar</span>
            </button>
        </form>
    @endsection
@endif
@section('modal')
    @if (!isset($mult))
        @include('components.modal.create', [
            'tite' => 'Confirmação de Participação',
            'message' => 'Tens certeza que prentendes convidar este o úsuario para esta reunião, o úsuario será notificado no seu email.',
        ])
    @endif
    @include('components.modal.search', [
        'action' => route('reuniao.users.search', $reuniao->id),
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
