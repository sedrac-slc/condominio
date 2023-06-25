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
    <th colspan="1">
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
            <td @if(howCreated($user->id)->isMoradorResidente())
                class="morador-residente enfase-modal"
                url="{{ route('user.api.get.apartamento', $user->id )}}"
                data-bs-toggle="modal" data-bs-target="#modalViApartamento"
                @endif>
                {{ rulesOfString($user->id) }}
            </td>
            <td>
                <button type="button" class="bg-none text-danger rounded text-center btn-create" data-bs-toggle="modal"
                    data-bs-target="#modalCreate"
                    url="{{ route('notificar.users.cancel', [$reuniao->id, $user->id]) }}">
                    <i class="fas fa-trash"></i>
                    <span>elimina</span>
                </button>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.create', [
        'tite' => 'Confirmação de Anulação',
        'message' => 'Tens certeza que desejas cancelar a participação deste úsuario nesta reunião, o úsuario será notificado no seu email.',
        'justify' => true
    ])
    @include('components.modal.search',[
        'action' => route('reuniao.users.search',$reuniao->id),
        'default' => "NAME",
        'method' => 'GET',
        'list' => ["NAME"=>"Nome","EMAIL"=>"Email","GENERO"=>"Género","TELEFONE"=>"Telefone","DATA_NASCIMENTO"=>"Data nascimento"]
    ])
    @include('components.modal.visualizador.apartamento')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/apartamento_user.js') }}"></script>
    <script src="{{ asset('js/visualizador/apartamento.js') }}"></script>
@endsection
