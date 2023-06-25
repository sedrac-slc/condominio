<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReclamacaoRequest;
use App\Models\Reclamacao;
use App\Models\User;
use App\Models\UserMembro;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamacaoController extends Controller
{
    public function user_menbros(){
        $panel = "reclamacao";
        $users = User::join('user_membros','user_membros.user_id','=','users.id')
                    ->select('users.*','user_membros.id as user_membro_id')
                    ->paginate();
        return view('page.reclamacao.users_membro',compact('users','panel'));
    }

    public function search(Request $request){
        $panel = "reclamacao";
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $users = User::join('user_membros','user_membros.user_id','=','users.id')
                    ->where($field,'like','%'.$search.'%')
                    ->select('users.*','user_membros.id as user_membro_id')
                    ->paginate();
        return view('page.reclamacao.users_membro',compact('users','panel'));
    }

    public function find(Request $request,$user_membro_id){
        $panel = "reclamacao";
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $userMembro = UserMembro::find($user_membro_id);
        $reclamacoes = Reclamacao::where('user_membro_id',$user_membro_id)
                    ->where($field,'like','%'.$search.'%')
                    ->paginate();
        return view('page.reclamacao.users_list_reclamacao',compact('reclamacoes','userMembro','panel'));
    }

    public function list($user_membro_id, $panel="", $back=""){
        $panel = $panel == "" ? "reclamacao" : $panel;

        $userMembro = UserMembro::find($user_membro_id);
        $reclamacoes = Reclamacao::where('user_membro_id',$user_membro_id)
                                ->orderBy('created_at','DESC')
                                ->paginate();

        $back = $back == "" ? route('reclamacao.users.home') : $back;

        return view('page.reclamacao.users_list_reclamacao',compact('reclamacoes','userMembro','panel','back'));
    }

    public function store(ReclamacaoRequest $request,$user_membro_id){
        try{
            $reclamacao = Reclamacao::create($request->all());
            $reclamacao->registerUser(Auth::user()->id);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception $e){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('reclamacao.user.list',$user_membro_id);
        }
    }

    public function update(ReclamacaoRequest $request,$id,$user_membro_id){
        try{

            $reclamacao = Reclamacao::find($id);
            $reclamacao->update($request->all());
            $reclamacao->registerUserUpdate(Auth::user()->id);
            $alertMessage = AlertMessage::WARNING();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('reclamacao.user.list',$user_membro_id);
        }
    }

    public function delete($id,$user_membro_id){
        try{
            $reclamacao = Reclamacao::find($id);
            $reclamacao->delete();
            $alertMessage = AlertMessage::SUCCESS();
            toastr()->success($alertMessage->message,$alertMessage->type);
        }catch(Exception){
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('reclamacao.user.list',$user_membro_id);
        }
    }

}
