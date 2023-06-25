@extends('layouts.page', ['list' => $pagamentos])
@section('buttons')
    <button class="text-primary bg-none" id="btn-add-pagamento" data-bs-toggle="modal" data-bs-target="#modalPagamento"
        url="{{ route('pagamento.create') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-home"></i><span>nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>valor</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>descrição</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-users"></i><span>morador</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($pagamentos as $pagamento)
        <tr>
            <td>{{ $pagamento->nome }}</td>
            <td>{{ $pagamento->valor }}</td>
            <td>{{ $pagamento->descricao }}</td>
            <td>
                <a class="d-f text-success text-decoration-none" href="{{ route('pagamento.users', $pagamento->id) }}">
                    <i class="fas fa-user-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a class="d-f text-info text-decoration-none" href="{{ route('pagamento.user.list', $pagamento->id) }}">
                    <i class="fas fa-user-check"></i>
                    <span>lista</span>
                </a>
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-danger btn-pagamento-del"
                    data-bs-toggle="modal" data-bs-target="#modalDel" url="{{ route('pagamento.delete', $pagamento->id) }}"
                    method="DELETE">
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
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.pagamento')
    @include('components.modal.search', [
        'action' => route('pagamento.search'),
        'default' => 'NOME',
        'method' => 'GET',
        'list' => ['NOME' => 'nome', 'VALOR' => 'valor', 'DESCRICAO' => 'descrição'],
    ])
    @include('components.modal.delete', [
        'message' => 'Desejas apagar o pagamento',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/pagamento.js') }}"></script>
@endsection
