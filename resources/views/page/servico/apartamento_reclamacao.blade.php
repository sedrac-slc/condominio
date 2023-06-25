@extends('layouts.page', ['list' => $apartamentos])
@section('buttons')
    <a class="text-primary text-decoration-none"
        href="{{ route('servico.home') }}{{ isset($reclamacao) ? '?reclamacao=true' : '' }}">
        <i class="fas fa-arrow-left"></i>
        <span>voltar</span>
    </a>
    <div class="mt-2">
        <h5>Serviço: {{ $servico->nome }}</h5>
    </div>
    <hr />
@endsection
@section('form-open')
    @if ($action == 'add' || $action == 'list')
        <form action="{{ route('servico.reclamacao') }}" method="POST">
            @csrf
            <input type="hidden" name="servico_id" value="{{ $servico->id }}">
            @if ($action == 'add')
                <div class="col-md-12">
                    <label for="motivo">
                        <i class="fas fa-list"></i>
                        <span>Motivo</span>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="motivo" id="motivo" value="{{ old('motivo') }}" />
                </div>
                <div class="col-md-12">
                    <label for="descricao">
                        <i class="fas fa-comment"></i>
                        <span>Descrição</span>
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="descricao" id="descricao" cols="30" rows="3" class="form-control"
                        value="{{ old('descricao') }}">

                </textarea>
                </div>
                <hr />
            @endif
    @endif
@endsection
@section('thead')
    @if ($action == 'add' || $action == 'list')
        <th>
            <span>#</span>
        </th>
    @endif
    <th>
        <div><i class="fas fa-home"></i><span>número_casa</span></div>
    </th>
    <th>
        <div><i class="fas fa-envelope"></i><span>dimensao</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>descrição</span></div>
    </th>
    <th>
        <div><i class="fas fa-users"></i><span>morador</span></div>
    </th>
    <th class="tb-view-action d-none">
        <div><i class="fas fa-plus"></i><span>Criado_por</span></div>
    </th>
    <th class="tb-view-action d-none">
        <div><i class="fas fa-edit"></i><span>Actualizado_por</span></div>
    </th>
    @if ($action == 'list')
        <th>
            <div><i class="fas fa-calendar"></i><span>Motivo</span></div>
        </th>
        <th>
            <div><i class="fas fa-comment"></i><span>Descrição</span></div>
        </th>
    @endif
@endsection
@section('form-end')
    @if ($action == 'add' || $action == 'list')
        </form>
    @endif
@endsection
@section('tbody')
    @foreach ($apartamentos as $apartamento)
        <tr>
            <td class="">
                <div class="d-f-j-c-c">
                    @if ($action == 'add')
                        @if ($apartamento->reclamacao($servico))
                            <button class="btn btn-danger rounded-circle" type="submit" name="del_apart"
                                value="{{ $apartamento->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <button class="btn btn-success rounded-circle" type="submit" name="add_apart"
                                value="{{ $apartamento->id }}">
                                <i class="fas fa-check"></i>
                            </button>
                        @endif
                    @elseif ($action == 'list')
                        <button class="btn btn-danger rounded-circle" type="submit" name="del_apart"
                            value="{{ $apartamento->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                </div>
            </td>
            <td>{{ $apartamento->num_casa }}</td>
            <td>{{ $apartamento->dimensao }}</td>
            <td>{{ $apartamento->descricao }}</td>
            <td
                @if ($apartamento->isClosed()) class="apartamento-user enfase-modal"
                data-bs-toggle="modal" data-bs-target="#modalViUser"
                url="{{ route('apartamento.api.get.user', $apartamento->id) }}" @endif>
                @if ($apartamento->isClosed())
                    {{ $apartamento->morador()->name }}
                @else
                    <a class="d-f text-success text-decoration-none"
                        href="{{ route('apartamento.users', $apartamento->id) }}">
                        <i class="fas fa-user-plus"></i>
                        <span>adicionar</span>
                    </a>
                @endif
            </td>
            <td class="tb-view-action d-none">
                <button type="button" class="bg-none text-secondary rounded text-center" data-bs-container="body"
                    data-bs-toggle="popover" data-bs-placement="bottom"
                    data-bs-content="{{ howCreated($apartamento->how_created)->name ?? '' }} em {{ $apartamento->created_at }}">
                    <i class="fas fa-info-circle"></i>
                    <span>ver</span>
                </button>
            </td>
            <td class="tb-view-action d-none">
                <button type="button" class="bg-none text-secondary rounded text-center" data-bs-container="body"
                    data-bs-toggle="popover" data-bs-placement="bottom"
                    data-bs-content="{{ howUpdated($apartamento->how_updated)->name ?? '' }} em {{ $apartamento->updated_at }}">
                    <i class="fas fa-info-circle"></i>
                    <span>ver</span>
                </button>
            </td>
            @if ($action == 'list')
                <td>{{ $apartamento->motivo }}</td>
                <td>{{ $apartamento->desc }}</td>
            @endif
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.apartamento')
    @include('components.modal.search', [
        'action' => route('servico.apartamento.reclamacao.search', [$action, $servico->id]),
        'default' => 'NUM_CASA',
        'method' => 'GET',
        'list' => [
            'NUM_CASA' => 'Número da casa',
            'DIMENSAO' => 'Dimensão',
            'DESCRICAO' => 'Descrição',
            'ESTADO' => 'Estado',
        ],
    ])
@endsection
