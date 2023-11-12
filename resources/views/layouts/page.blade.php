@extends('layouts.dashboard')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/paginate.css') }}" />
@endsection
@section('painel')
    <section class="shadow p-2  mt-4 bg-white">
        <div class="position-relative pb-3">
            <div class="m-2">
                @yield('buttons')
            </div>
            <div class="float">
                <button class="bg-none border rounded" id="btn-search" data-bs-toggle="modal" data-bs-target="#modalSearch">
                    <i class="fas fa-search"></i>
                    <span>pesquisar</span>
                </button>
            </div>
        </div>
        @include('components.message')
        @include('components.errors')
        @yield('page-container')
        @yield('form-open')
        <div class="table-responsive mt-4">
            <table class="table table-hover table-borderless text-center">
                <thead>
                    <tr>
                        @yield('thead')
                    </tr>
                </thead>
                <tbody>
                    @yield('tbody')
                </tbody>
            </table>
        </div>
        @yield('form-end')
        @if ($list->total() == 0)
            <div class="msg-empty">
                Nenhum registo encontrado.
            </div>
        @endif
        <div id="pag" class="mt-3">
            {{ $list->links() }}
        </div>
    </section>
    @yield('modal')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
