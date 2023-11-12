@extends('layouts.template')
@section('body', 'bg-light')
@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
@endsection
@section('content')
<div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-dark text-white position-relative" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom">Condominio</div>
        <div class="list-group list-group-flush">
            <a href="{{ route('home') }}"
                class="@isset($panel) @if ($panel == 'home') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-3">
                <i class="fas fa-solar-panel"></i>
                <span>Painel</span>
            </a>
            @isset(Auth::user()->user_membro->id)
            <a href="{{ route('user.home') }}"
                class="@isset($panel) @if ($panel == 'user') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-3">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <a href="{{ route('servico.home') }}"
                class="@isset($panel) @if ($panel == 'servico') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-3">
                <i class="fas fa-tools"></i>
                <span>Serviço</span>
            </a>
            <a href="{{ route('apartamento.home') }}"
                class="@isset($panel) @if ($panel == 'apartamento') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-3">
                <i class="fas fa-home"></i>
                <span>Apartamento</span>
            </a>
            <a href="{{ route('reuniao.home') }}"
                class="@isset($panel) @if ($panel == 'reuniao') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-3">
                <i class="fas fa-comment"></i>
                <span>Reunião</span>
            </a>
            @endisset
            <a href="{{ route('pagamento.home') }}"
                class="@isset($panel) @if ($panel == 'pagamento') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-3"
                style="border-top: 1px solid #fff;">
                <i class="fas fa-money-bill"></i>
                <span>Pagamentos</span>
            </a>
            <div class="">
                <div class="list-group-item  p-3 text-white"
                    style="text-decoration: none; background: transparent; border-bottom:1px solid white;">
                    <i class="fas fa-list"></i>
                    <span>Reclamação</span>
                </div>
                <ul class="mt-1 bg-dark p-1" style="margin-left: 30px; margin-top: 2px; list-style:none;">
                    <li>
                        <a href="{{ route('reclamacao.users.home') }}"
                            class="@isset($panel) @if ($panel == 'reclamacao') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-1"
                            style="border: none">
                            <i class="fas fa-users"></i>
                            <span>Comissão</span>
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('servico.home') }}?reclamacao=true"
                            class=" @isset($panel) @if ($panel == 'reclamacao_servico') list-group-item-action  @else list-group-item-dark @endif @endisset list-group-item  p-1"
                            style="border: none">
                            <i class="fas fa-tools"></i>
                            <span>Serviços</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="div-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn bg-danger text-white shadow rounded">
                    <i class="fas fa-power-off"></i>
                    <span>logaut</span>
                </button>
            </form>
        </div>
    </div>

    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-primary rounded" id="sidebarToggle">Menu</button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse justify-content-md-center" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">
                                <i class="fas fa-home"></i>
                                <span>Página inicial</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="fas fa-user"></i>
                                <span>Ajuda</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <div class="container-fluid">
            @yield('painel')
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script src="{{ asset('js/sidebar.js') }}"></script>
@endsection
