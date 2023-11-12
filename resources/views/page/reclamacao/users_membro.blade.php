@extends('layouts.page', ['list' => $users])
@section('buttons')
    <div class="d-flex align-item-center g-1">
        <a href="{{ route('home') }}" class="text-decoration-none h5">
            <i class="fas fa-arrow-left"></i>
            <span>voltar</span>
        </a>
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
    <th class="tb-view-action d-none">
        <div><i class="fas fa-plus"></i><span>Criado_por</span></div>
    </th>
    <th class="tb-view-action d-none">
        <div><i class="fas fa-edit"></i><span>Actualizado_por</span></div>
    </th>
    <th colspan="2">
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
                <a class="d-f text-success text-decoration-none link-add" href="#" data-bs-toggle="modal" data-bs-target="#modalReclamacao"
                url="{{ route('reclamacao.create', $user->user_membro_id) }}" user="{{ $user->user_membro_id }}">
                    <i class="fas fa-user-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a class="d-f text-info text-decoration-none" href="{{ route('reclamacao.user.list',$user->user_membro_id) }}">
                    <i class="fas fa-user-check"></i>
                    <span>listar</span>
                    <sup>
                        <span class="badge bg-primary rounded-circle h5">
                            {{ reclamacaoUser($user->user_membro_id) }}
                        </span>
                    </sup>
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
    @include('components.modal.search',[
        'action' => route('reclamacao.users.search'),
        'default' => "NAME",
        'method' => 'GET',
        'list' => ["NAME"=>"Nome","EMAIL"=>"Email","GENERO"=>"Género","TELEFONE"=>"Telefone","DATA_NASCIMENTO"=>"Data nascimento"]
    ])
    @include('components.modal.reclamacao')
@endsection
@section('script')
    @parent
    <script>
        (function(win, doc){
            "use strict";

            const linkAdd = doc.querySelectorAll(".link-add");
            const userMembro = doc.querySelector("#user_membro_id");
            const formReclamacao = doc.querySelector('#form-reclamacao');

            linkAdd.forEach(item => {
                item.addEventListener('click', (e) =>{
                    userMembro.value = item.getAttribute("user");
                    formReclamacao.action = item.getAttribute("url");
                });
            });

        }(window,document));
    </script>
@endsection
