@extends('layouts.template')
@section('body','bg-dark')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}" />
@endsection
@section('content')
    <form method="POST" action="{{ route('login') }}" class="w-50 bg-white">
        @csrf
        <a class="back" href="/">
            <i class="fas fa-arrow-alt-circle-left fa-2x"></i>
            <span>voltar</span>
        </a>
        @include('components.message')
        @include('components.errors')
        <div class="form-group mt-2">
            <label for="email">
                <i class="fas fa-envelope"></i>
                <span>Email:</span>
            </label>
            <input id="email" class="form-control mt-1 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}"
                required autofocus />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-4">
            <label for="password">
                <i class="fas fa-key"></i>
                <span>Senha:</span>
            </label>
            <input id="password" class="form-control mt-1 @error('password') is-invalid @enderror" type="password" name="password" required
            />
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-4">
            <button class="btn btn-outline-success" type="submit">
                <i class="fas fa-user"></i>
                <span>autenticação</span>
            </button>
        </div>
        <div class="block mt-3">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">lembra-se de mí.</span>
            </label>
        </div>
        <div class="flex items-center justify-end mt-2 mb-2">
            @if (Route::has('password.request'))
                <a class="text-primary mb-2 t-d-n" href="{{ route('password.request') }}">
                    <i class="fas fa-key"></i>
                    <span class="ml-1">Não lembro da minha senha.</span>
                </a>
            @endif
        </div>
        <div class="mb-3">
            <a class="text-info mt-2 t-d-n" href="{{ route('register') }}">
                <i class="fas fa-file-alt"></i>
                <span class="ml-1">Não tenho nenhuma conta.</span>
            </a>
        </div>
    </form>
@endsection
