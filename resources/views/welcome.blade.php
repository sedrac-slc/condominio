@extends('layouts.template')
@section('body', 'd-flex text-center text-white bg-dark')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cover.css') }}" />
@endsection
@section('content')
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Condomínio</h3>
            </div>
        </header>

        <main class="px-3 bg-p">
            <h1>Bem vindo.</h1>
            <hr class="bg-white"/>
            <p class="lead">
                Este é o website do condomínio nova esperença do Luongo, aqui é o local onde poderás
                encontrar qualquer informação relacionada com esta instituação.
            </p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('home') }}" class="btn btn-warning btn-lg mt-1 rounded">
                        <i class="fas fa-solar-panel"></i>
                        <span>Painel</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary m-1 rounded">
                        <i class="fas fa-lock"></i>
                        <span>Autenticação</span>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-info m-1 rounded">
                            <i class="fas fa-file-alt"></i>
                            <span>Cadastramento</span>
                        </a>
                    @endif
                @endauth
            @endif
        </main>

        <footer class="mt-auto text-dark">
            <p>{{ (new DateTime())->format('y-m-d') }}</p>
        </footer>

    </div>
@endsection
