<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\PagamentoUser;
use App\Models\User;
use App\Models\UserMorador;
use App\Utils\AlertMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagamentoUserController extends Controller
{
    public function users($id,$optional = true){
        $panel = "pagamento";
        $pagamento = Pagamento::find($id);
        $builds = User::join('user_moradors','user_moradors.user_id','=','users.id')
                    ->select('users.*','user_moradors.id as user_morador_id')
                    ->orderBy('user_moradors.id','DESC');
        $view = 'page.pagamento.';
        if($optional){
            $users = $builds->paginate();
            $view .= 'users';
        }else{
            $users = $builds
                    ->join('pagamento_users','pagamento_users.user_morador_id','=','user_moradors.id')
                    ->where('pagamento_users.pagamento_id',$pagamento->id)
                    ->paginate();
            $view .= 'list';
        }
        return view($view,compact('users','pagamento','panel'));
    }

    public function list($id){
        return $this->users($id,false);
    }

    public function users_store($pagamento_id, $user_id){
        try {

            PagamentoUser::create([
                'user_morador_id'=>$user_id,
                'pagamento_id'=>$pagamento_id,
                'how_created'=>Auth::user()->id,
                'how_updated'=>Auth::user()->id,
            ]);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message,$alertMessage->type);
        } catch (Exception) {
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message,$alertMessage->type);
        }finally{
            return redirect()->route('pagamento.home');
        }
    }

    public function search(Request $request,$pagamento_id){
        $panel = "pagamento";
        $pagamento = pagamento::find($pagamento_id);
        $field = strtolower($request->field);
        $search =htmlspecialchars($request->search);
        $users = UserMorador::usersNotpagamento()->where($field,'like','%'.$search.'%')
                     ->orderBy('id','DESC')
                     ->paginate();
        return view('page.pagamento.user',compact('users','pagamento','panel'));
    }

}
