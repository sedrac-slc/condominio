@extends('layouts.dashboard')
@section('painel')
    <section class="shadow p-2 mt-4 bg-white">
        <div>
            <div>
                <p>
                    <span class="h6">Nome: </span>
                    <span>{{ Auth::user()->name }}</span>
                </p>
            </div>
        </div>
        <hr>
        <div class="row w-100">
            <div class="col-md-4 pt-1">
                <div class="border rounded text-center">
                    <a href="{{ route('painel.reuniao',Auth::user()->id) }}" class="text-decoration-none text-dark">
                        <i class="fas fa-comment"></i>
                        <span>Reunião</span>
                        <sup>
                            <span class="badge bg-primary rounded-circle h5">
                                {{ $status->reuniao }}
                            </span>
                        </sup>
                    </a>
                </div>
            </div>
            <div class="col-md-4 pt-1">
                <div class="border rounded text-center">
                    <a href="{{ route('painel.reclamacao',Auth::user()->id) }}" class="text-decoration-none text-dark">
                        <i class="fas fa-list"></i>
                        <span>Reclamação</span>
                        <sup>
                            <span class="badge bg-primary rounded-circle h5">
                                {{ $status->reclamacao }}
                            </span>
                        </sup>
                    </a>
                </div>
            </div>
            <div class="col-md-4 pt-1">
                <div class="border rounded text-center">
                    <a href="{{ route('painel.pagamento',Auth::user()->id) }}" class="text-decoration-none text-dark">
                        <i class="fas fa-money-bill"></i>
                        <span>Pagamentos</span>
                        <sup>
                            <span class="badge bg-primary rounded-circle h5">
                                {{ $status->pagamento }}
                            </span>
                        </sup>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <p>Paineis:</p>
            <ul type="none">
                <li>
                    <i class="fas fa-users"></i>
                    <span>
                        Usuarios: é apresenta as informações reclacionado com os úsuarios deste sistema.
                    </span>
                </li>
                <li>
                    <i class="fas fa-home"></i>
                    <span>Apartamento: apresenta as informações relacionadas com os apartamento do condominio.</span>
                </li>
                <li>
                    <i class="fas fa-comment"></i>
                    <span>Reunião: gerenciamento das reuniões no condominio.</span>
                </li>
                <li>
                    <i class="fas fa-list"></i>
                    <span>Reclamação: neste painel, o feito o gerenciamento das reclamações dos moradores.</span>
                </li>
            </ul>
        </div>
    </section>
@endsection
