<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AgendarServicoController,
    HomeController,
    UserController,
    ApartamentoController,
    ApartamentoUserController,
    ReuniaoController,
    NotificacaoController,
    ReclamacaoController,
    PagamentoController,
    ServicoController,
    PagamentoUserController,
    ReclamacaoServicoController
};
use App\Models\Notificacao;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/register/user', [UserController::class, 'register'])->name('register.user');

Route::group(['auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::group(["prefix" => "painel", 'auth'], function(){
    Route::get('/reuniao/{user_id}', [HomeController::class, 'reuniao'])->name('painel.reuniao');
    Route::get('/pagamento/{user_id}', [HomeController::class, 'pagamento'])->name('painel.pagamento');
    Route::get('/reclamacao/{user_id}', [HomeController::class, 'reclamacao'])->name('painel.reclamacao');
});

Route::group(["prefix" => "users", 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.home');
    Route::post('/', [UserController::class, 'create'])->name('user.create');

    Route::put('/', [UserController::class, 'update'])->name('user.update');
    Route::put('/{id}', [UserController::class, 'update_user'])->name('user.update.other');

    Route::delete('/', [UserController::class, 'delete'])->name('user.delete');
    Route::delete('/{id}', [UserController::class, 'delete_user'])->name('user.delete.other');

    Route::get('/search', [UserController::class, 'search'])->name('user.search');

    Route::group(["prefex" => "api"], function () {
        Route::get('/apartamento/{user_id}', [UserController::class, 'getApartamentoUser'])->name('user.api.get.apartamento');
    });
});

Route::group(["prefix" => "apartamentos", 'auth'], function () {
    Route::get('/', [ApartamentoController::class, 'index'])->name('apartamento.home');
    Route::post('/', [ApartamentoController::class, 'store'])->name('apartamento.create');
    Route::put('/{id}', [ApartamentoController::class, 'update'])->name('apartamento.update');
    Route::delete('/{id}', [ApartamentoController::class, 'delete'])->name('apartamento.delete');

    Route::get('/users/{id}', [ApartamentoUserController::class, 'users'])->name('apartamento.users');

    Route::get('/search', [ApartamentoController::class, 'search'])->name('apartamento.search');

    Route::group(["prefex" => "api"], function () {
        Route::get('/user/{apart_id}', [ApartamentoController::class, 'getUserInApartamento'])->name('apartamento.api.get.user');
    });
});

Route::group(["prefix" => "apartamento-users"], function () {
    Route::post('/{apartamento_id}/{user_id}', [ApartamentoUserController::class, 'users_store'])->name('apartamento.users.store');
    Route::get('/{apartamento_id}', [ApartamentoUserController::class, 'search'])->name('apartamento.users.search');
});

Route::group(["prefix" => "notificao-users"], function () {
    Route::post('/{apartamento_id}/{user_id}', [NotificacaoController::class, 'notificar_store'])->name('reuniao.notificar.store');
    Route::get('/{reuniao_id}', [NotificacaoController::class, 'search'])->name('reuniao.users.search');
});

Route::group(["prefix" => "reunioes", 'auth'], function () {
    Route::get('/', [ReuniaoController::class, 'index'])->name('reuniao.home');
    Route::post('/', [ReuniaoController::class, 'store'])->name('reuniao.create');
    Route::put('/{id}', [ReuniaoController::class, 'update'])->name('reuniao.update');
    Route::delete('/{id}', [ReuniaoController::class, 'delete'])->name('reuniao.delete');

    Route::get('/users/notificar/{id}', [NotificacaoController::class, 'users_notificacao'])->name('notificar.users');
    Route::get('/users/confirm/{id}', [NotificacaoController::class, 'users_confirmacao'])->name('confirm.users');
    Route::post('/users/notificar/mult/{id}', [NotificacaoController::class, 'notificar_store_mult'])->name('notificar.users.mult');

    Route::get('/search', [ReuniaoController::class, 'search'])->name('reuniao.search');

    Route::post('/users/notificar/{reuniao_id}/{user_id}', [NotificacaoController::class, 'users_notificacao_cancel'])->name('notificar.users.cancel');
});

Route::group(["prefix" => "reclamacaoes", 'auth'], function () {
    Route::get('/users', [ReclamacaoController::class, 'user_menbros'])->name('reclamacao.users.home');

    Route::get('/list/{user_membro_id}', [ReclamacaoController::class, 'list'])->name('reclamacao.user.list');

    Route::get('/users/search', [ReclamacaoController::class, 'search'])->name('reclamacao.users.search');
    Route::get('/search/{user_membro_id}', [ReclamacaoController::class, 'find'])->name('reclamacao.search');

    Route::post('/store/{user_membro_id}', [ReclamacaoController::class, 'store'])->name('reclamacao.create');
    Route::put('/{id}/{user_membro_id}', [ReclamacaoController::class, 'update'])->name('reclamacao.update');
    Route::delete('/{id}/{user_membro_id}', [ReclamacaoController::class, 'delete'])->name('reclamacao.delete');
});

Route::group(["prefix" => "pagamento", 'auth'], function () {
    Route::get('/', [PagamentoController::class, 'index'])->name('pagamento.home');
    Route::post('/', [PagamentoController::class, 'store'])->name('pagamento.create');
    Route::put('/{id}', [PagamentoController::class, 'update'])->name('pagamento.update');
    Route::delete('/{id}', [PagamentoController::class, 'delete'])->name('pagamento.delete');

    Route::get('/users/{id}', [PagamentoUserController::class, 'users'])->name('pagamento.users');

    Route::get('/search', [PagamentoController::class, 'search'])->name('pagamento.search');
});

Route::group(["prefix" => "servicos", 'auth'], function () {
    Route::get('/', [ServicoController::class, 'index'])->name('servico.home');
    Route::post('/', [ServicoController::class, 'store'])->name('servico.create');
    Route::put('/{id}', [ServicoController::class, 'update'])->name('servico.update');
    Route::delete('/{id}', [ServicoController::class, 'delete'])->name('servico.delete');
    Route::get('/search', [ServicoController::class, 'search'])->name('servico.search');

    Route::get('/apartamento/{action}/{service_id}', [ServicoController::class, 'apartamento'])->name('servico.apartamento');
    Route::get('/apartamento/{action}/{service_id}/search', [ServicoController::class, 'apartamento_search'])->name('servico.apartamento.search');

    Route::get('/apartamento/reclamacao/{action}/{service_id}', [ReclamacaoServicoController::class, 'apartamento'])->name('servico.apartamento.reclamacao');
    Route::get('/apartamento/reclamacao/{action}/{service_id}/search', [ReclamacaoServicoController::class, 'apartamento_search'])->name('servico.apartamento.reclamacao.search');
});

Route::post('/servico/agendar', [AgendarServicoController::class, 'store_service'])->name('servico.agendar');
Route::post('/servico/reclamacao', [ReclamacaoServicoController::class, 'store_service'])->name('servico.reclamacao');

Route::group(["prefix" => "pagamento-users"], function () {
    Route::post('confirmacao/{pagamento_user_id}', [PagamentoUserController::class, 'users_confirm'])->name('pagamento.users.confirm');
    Route::post('/{pagamento_id}/{user_id}', [PagamentoUserController::class, 'users_store'])->name('pagamento.users.store');
    Route::get('/{pagamento_id}', [PagamentoUserController::class, 'search'])->name('pagamento.users.search');
    Route::get('/list/{pagamento_id}', [PagamentoUserController::class, 'list'])->name('pagamento.user.list');
});
