@extends('layouts.page', ['list' => $users])
@section('buttons')
    <div class="d-flex align-item-center g-1">
        <a href="{{ url()->previous() }}" class="text-decoration-none h5">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
        <h5 class=""> <span>Numéro casa:</span> {{ $apartamento->num_casa }} </h5>
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
        <div><i class="fas fa-tools"></i><span>Acção</span></div>
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
                <button type="button" class="bg-none text-secondary rounded text-center btn-create" data-bs-toggle="modal" data-bs-target="#modalCreate"  url="{{ route('apartamento.users.store',[$apartamento->id, $user->user_morador_id]) }}">
                    <i class="fas fa-check-square text-success"></i>
                    <span>escolher</span>
                </button>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.create',[
        'tite' => 'Confirmação',
        'message' => 'Tens certeza que prentendes efectuar esta acção'
    ])
    @include('components.modal.search',[
        'action' => route('apartamento.users.search',$apartamento->id),
        'default' => "NAME",
        'method' => 'GET',
        'list' => ["NAME"=>"Nome","EMAIL"=>"Email","GENERO"=>"Género","TELEFONE"=>"Telefone","DATA_NASCIMENTO"=>"Data nascimento"]
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/apartamento_user.js') }}"></script>
@endsection
