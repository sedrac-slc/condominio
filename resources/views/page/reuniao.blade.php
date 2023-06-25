@extends('layouts.page', ['list' => $reunioes])
@section('buttons')
    <button class="text-primary bg-none" id="btn-add-reuniao" data-bs-toggle="modal" data-bs-target="#modalApartamanto"
        url="{{ route('user.create') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@section('thead')
    <th>
        <div><i class="fas fa-home"></i><span>tema</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>Data</span></div>
    </th>
    <th>
        <div><i class="fas fa-clock"></i><span>Hora começo</span></div>
    </th>
    <th colspan="3">
        <div><i class="fas fa-phone"></i><span>Notifição</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($reunioes as $reuniao)
        <tr>
            <td>{{ $reuniao->tema }}</td>
            <td>{{ $reuniao->data }}</td>
            <td>{{ $reuniao->hora_comeco }}</td>
            <td>
                <a class="d-f text-success text-decoration-none" href="{{ route('notificar.users',$reuniao->id) }}">
                    <i class="fas fa-user-plus"></i>
                    <span>adicionar(1)</span>
                </a>
            </td>
            <td>
                <a class="d-f text-info text-decoration-none" href="{{ route('confirm.users',$reuniao->id) }}">
                    <i class="fas fa-user-check"></i>
                    <span>lista</span>
                    <sup>
                        <span class="badge bg-primary rounded-circle h5">{{ countUserInReuniao($reuniao) }}</span>
                    </sup>
                </a>
            </td>
            <td>
                <a class="d-f text-warning text-decoration-none" href="{{ route('notificar.users',$reuniao->id) }}?type=plus">
                    <i class="fas fa-users"></i>
                    <span>adicionar(+)</span>
                </a>
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-danger btn-reuniao-del" data-bs-toggle="modal"
                    data-bs-target="#modalDel" url="{{ route('reuniao.delete', $reuniao->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
            <td>
                <a href="#" class="d-f bg-none text-decoration-none text-warning btn-reuniao-tr" data-bs-toggle="modal"
                    data-bs-target="#modalApartamanto"  url="{{ route('reuniao.update', $reuniao->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.reuniao')
    @include('components.modal.search',[
        'action' => route('reuniao.search'),
        'default' => "tema",
        'method' => 'GET',
        'list' => ["TEMA"=>"Tema","DATA"=>"Data","HORA_COMECO"=>"Hora começo"]
    ])
    @include('components.modal.delete', [
        'message' => 'Desejas apagar o reunião',
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/page/reuniao.js') }}"></script>
@endsection
