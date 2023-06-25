@extends('layouts.template')
@section('body','bg-dark')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}" />
@endsection
@section('content')
    <form method="POST" action="{{ route('register.user') }}" class="w-75 bg-white register">
        @csrf
        <a class="back mb-1" href="/">
            <i class="fas fa-arrow-alt-circle-left fa-2x"></i>
            <span>voltar</span>
        </a>

        @include('components.message')
        @include('components.errors')

       @include('components.import.user')

        <div class="mt-4">
            <button class="btn btn-outline-success" type="submit">
                <i class="fas fa-file-alt"></i>
                <span>cadastramento</span>
            </button>
        </div>
        <div class="flex items-center justify-end mt-2 mb-2">
            <a class="text-primary t-d-n" href="{{ route('login') }}">
                <i class="fas fa-user"></i>
                <span class="ml-1">Já tenho uma conta</span>
            </a>
        </div>

    </form>
@endsection
