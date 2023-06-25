<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use App\Models\Pagamento;
use App\Models\PagamentoUser;
use App\Models\Reclamacao;
use App\Models\Reuniao;
use App\Models\UserMembro;
use App\Utils\AlertMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $panel = "home";

        $id = Auth::user()->id;

        $reuniao_c = Notificacao::where('user_id',$id)->count();

        $pagamento_c = PagamentoUser::join('user_moradors as um','um.id','=','user_morador_id')
                        ->join('users as u','um.user_id','=','u.id')
                        ->where('um.user_id',$id)
                        ->count();

        $reclamacao_c = Reclamacao::join('user_membros as um','um.id','=','user_membro_id')
                        ->join('users as u','um.user_id','=','u.id')
                        ->where('um.user_id',$id)
                        ->count();

        $status = (object)[
            "reuniao" => $reuniao_c, "pagamento" => $pagamento_c, "reclamacao" => $reclamacao_c
        ];

        return view('home',compact('panel','status'));
    }


    public function reuniao($user_id){
        $panel = "home";
        $reunioes = Reuniao::join('notificacaos','reuniao_id','=','reuniaos.id')
                    ->where('user_id',$user_id)
                    ->select('reuniaos.*')
                    ->orderBy('created_at','DESC')
                    ->paginate();
        return view('page.reuniao',compact('reunioes','panel'));
    }

    public function reclamacao($user_id){
        $panel = "home";
        $membro = UserMembro::where('user_id',$user_id)->first();

        if(!isset($membro->id)){
            $alertMessage = AlertMessage::DANGER();
            toastr()->warning($alertMessage->message,$alertMessage->type);
        }

        $reclamacaoController = new ReclamacaoController();
        return $reclamacaoController->list($membro->id, $panel , route('home'));
    }

    public function pagamento($user_id){
        $user_id = 13;
        $panel = "home";
        $pagamentos = Pagamento::join('pagamento_users','pagamento_id','=','pagamentos.id')
                ->join('user_moradors','user_morador_id','=','user_moradors.id')
                ->where('user_moradors.user_id',$user_id)
                ->orderBy('pagamento_users.created_at','DESC')
                ->select('pagamentos.*','pagamento_users.created_at as date_create')
                ->distinct('pagamento_id')
                ->paginate();
        return view('page.pagamento.recentes',compact('pagamentos','panel'));
    }


}
