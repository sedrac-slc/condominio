@extends('layouts.page', ['list' => $users])
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
@endsection
@section('tbody')
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->genero }}</td>
            <td>{{ $user->telefone }}</td>
            <td>{{ $user->data_nascimento }}</td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.create',[
        'tite' => 'Confirmação',
        'message' => 'Tens certeza que prentendes efectuar esta acção'
    ])
    @include('components.modal.search',[
        'action' => route('pagamento.users.search',$pagamento->id),
        'default' => "NAME",
        'method' => 'GET',
        'list' => ["NAME"=>"Nome","EMAIL"=>"Email","GENERO"=>"Género","TELEFONE"=>"Telefone","DATA_NASCIMENTO"=>"Data nascimento"]
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/apartamento_user.js') }}"></script>
@endsection
